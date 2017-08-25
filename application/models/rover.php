<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26.02.2017
 * Time: 15:07
 */
class Model_rover{
    function __construct(){
        //echo 'Это конструкционный метод вызванный подключение модели '.__CLASS__.'<br>';
    }

    public function show_something_else(){
        //echo 'Это результат выполнения метода модели вызванного из контроллера<br>';
    }

    public function start()
    {
//        echo $_SESSION['form_id'];
//        print_r($_SESSION);
        global $db;
        if ((isset($_SESSION['form_id'])) && (isset($_SESSION['step_id']))) {
            header("Location:/forms");
        } else {

            //  если пользователь сотрудник
            if (($_SESSION['role_id']) && ($_SESSION['role_id'] == 3)) {
                // ищим непройденный материалы
                $sql = "SELECT
/* Вывод наименьшего непройденого трека*/
  MIN(route_control_step.track_number_id) AS track

  FROM
    (
    /* шаги и треки */
   SELECT
      STEP1.id AS StepID, DOC.id
      FROM
         route_doc AS DOC, route_control_step AS STEP1
        WHERE
        /* по компании */
           DOC.company_id = ". $_SESSION['control_company'] ."
           AND
           /* все треки + персональные треки по сотруднику */
               (DOC.employee_id IS NULL OR DOC.employee_id = ". $_SESSION['employee_id'] .")
           AND
           /* по всем должностям или по должности конкретного сотрудика */
               (DOC.item_type_id IS NULL
          OR

              DOC.item_type_id =
            /* Start Ищем ID Должности из таблици employees_item_node для заданного сотрудника employe.id */
              (SELECT EmplOrg.kladr_id
                FROM
                  employees AS Empl, employees_items_node AS EmplItem, organization_structure AS EmplOrg
                WHERE
                /* пара сотрудник-связывающаа таблица */
                  Empl.id = EmplItem.employe_id
                  AND
                  /* пара связывающаа таблица - орг структура */
                  EmplItem.org_str_id=EmplOrg.id
                  AND
                  /* конкретный сотрудник */
                  Empl.id = ". $_SESSION['employee_id'] .")
          )
              /* END Ищем ID Должности из таблици employees_item_node для заданного сотрудника employe.id */
          AND
          /* по всем узлам или по конкретному узлу */
               (DOC.organization_structure_id IS NULL
        OR
              DOC.organization_structure_id in
            /* Start Вхождение по относиться ли указанный epmloyys.id Сотрудник - в необходимое подразделение */
              (SELECT ORG3.id
            FROM

             organization_structure AS ORG3,

              (SELECT EmplOrg2.left_key, EmplOrg2.right_key
               /* получаем правый и левый ключи по конкретной должности сотрудника */
                FROM
                  employees AS Empl2,
                  employees_items_node AS EmplItem2,
                  organization_structure AS EmplOrg2
                WHERE
                  Empl2.id = EmplItem2.employe_id
                  AND
                  EmplItem2.org_str_id=EmplOrg2.id
                  AND
                  Empl2.id = ". $_SESSION['employee_id'] .") AS PARENT
            WHERE
            /* выявляем родитетей*/
              ORG3.left_key <= PARENT.left_key
              AND
              ORG3.right_key >= PARENT.right_key)
          )
        AND
              STEP1.track_number_id = DOC.id
   ) AS StepResult  /*  - таблица всех степов для конкретного сотрудника */
    LEFT JOIN
      (SELECT  /* все шаги сотрудника */
          history_step.step_id AS History,history_step.`data_finish`
          FROM
             history_step
          WHERE
             history_step.employee_id =". $_SESSION['employee_id'] .") AS HistoryStep
      ON StepResult.StepID = HistoryStep.History
       /* наложили пройденные шаги на все шаги сотрудника */
    LEFT JOIN
      route_control_step
      ON
      route_control_step.id = StepResult.StepID  /* добавлили все шоги сотрудника, даже те которые он не начинал проходить */
  WHERE
  /* Только незаконьченные шаги*/
    HistoryStep.History IS NULL OR (
    periodicity is not NULL AND  now() >=  (data_finish + INTERVAL periodicity MONTH)
    )";

                $control_test = $db->row($sql);
//                $track = "";
//                echo $sql;
                //  есть ли хоть один трек для прохождения
                if ($control_test['track'] != NULL) {
                   $track = $control_test['track'];// если есть тогда присваеваем
                    // запрашиваем массив матералов сотрудника с учётом трека
                    $sql = "SELECT
  CompanyRoute.id AS TRACK, route_control_step.id, route_control_step.son_step,
  StartStep.route_start_step, HISTORYRESULT.HistoryStep,periodicity,data_finish
  FROM route_control_step
  LEFT JOIN route_doc AS StartStep
    ON (route_control_step.id = StartStep.route_start_step AND StartStep.id = route_control_step.track_number_id)
  LEFT JOIN route_doc AS CompanyRoute
    ON CompanyRoute.id = route_control_step.track_number_id
  LEFT JOIN
    (SELECT history_step.step_id AS HistoryStep,history_step.data_finish
      FROM history_step
      WHERE history_step.employee_id = " . $_SESSION['employee_id'] . ") AS HISTORYRESULT
    ON HISTORYRESULT.HistoryStep = route_control_step.id

  WHERE route_control_step.track_number_id = ". $track ." AND CompanyRoute.company_id =". $_SESSION['control_company'];

                    $control_test_array = $db->all($sql);
                    $step_pointer = 0; // пункт начала пути
//                echo $sql;
                    // Формируем ассоциативный массив из ответа
                    foreach ($control_test_array as $control_tests_item) {
                        $link[$control_tests_item['id']] =
                            ["son_step" => $control_tests_item['son_step'],
                                "HistoryStep" => $control_tests_item['HistoryStep'],
                                "periodicity" => $control_tests_item['periodicity'],
                                "data_finish" => $control_tests_item['data_finish'],
                                "threeMonth" => date('Y-m-d', strtotime(date("Y-m-d") . '+ 3 month')),
//                        "step_content_id"=>$control_tests_item['step_content_id'],
                            "id" => $control_tests_item['id']
                        ];

                        if ($control_tests_item["route_start_step"] != NULL) {
                            $step_pointer = $control_tests_item['id'];
                        };
                    }
//                    print_r($link);

                    $content = "";
                    do {
                        if (($link[$step_pointer]["HistoryStep"] == NULL) || (isset($link[$step_pointer]["periodicity"])
                                && ($link[$step_pointer]["data_finish"] >= date('Y-m-d', strtotime(date("Y-m-d") . '-'. $link[$step_pointer]["periodicity"] .' month'))))) {
                            $content = "1";
                        } else {
                            if ($link[$step_pointer]["son_step"] != 0) {
                                $step_pointer = $link[$step_pointer]["son_step"];
                            } else { // законьчились материалы для проходжения
                                $content = "No";
                                header("Location: /dead_end");// переходим в тупик
                            }
                        }
                    } while ($content == "");


                   $_SESSION['step_id'] = $link[$step_pointer]['id']; // номер шага


                    if(isset($_SESSION['step_id'])){
                        header("Location:/pass_test");// переходим на тест

//                        print_r($_SESSION);
                    } else {
                        print_r($_SESSION) .  " <br><br><>br" ;

                    }


                } else {

                    header("Location:/dead_end");// переходим в тупик
                }
            }
        }

    }

}