<?php


$report_temp_mail = <<< HERE
<table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;width:100%;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;background-color:#f5f3eb;">
      <tbody><tr>
        <td align="center" style="font-family:Merriweather,Charter,Georgia,serif;">
          <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;width:100%;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">
            <tbody>

            <tr>
              <td width="100%" cellpadding="0" cellspacing="0" style="font-family:Merriweather,Charter,Georgia,serif;">
                <table align="center" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#ffffff;">

                      <tbody>
                      <!-- Header -->
                      <tr>
                        <td style="font-family:Merriweather,Charter,Georgia,serif;padding-top:30px;padding-bottom:30px;padding-right:0;padding-left:0;text-align:center;background-color:#ffde00;">
                          <h2 style=" font-family: monospace;
                                          font-weight: bold;
                                          font-size: 28px;
                                          margin-top: 0;
                                          margin-bottom: 10px;
                                          color: #333333;
                                          margin: 0 auto;">Labor<b>Pro</b></h2>
                        </td>
                      </tr>
                      <!-- Header end -->
                      <!-- Hi -->


                      <tr>
                        <td style=" font-family:Merriweather,Charter,Georgia,serif;padding-top:20px;padding-bottom:20px;padding-right:10%;padding-left:10%;background-color:#ffffff;">
                          <div style="font-family:Merriweather,Charter,Georgia,serif;margin-top:0;font-size:16px;line-height:25px;text-align:left;color:#777777  ;">
                                            <h2>Здравствуйте %fio%,</h2>
                                             Вы успешно
                                                авторизовались в системе LaborPRO. Данная
                                                система поможет Вам ознакомиться с
                                                материалами   по безопасности на вашем
                                                рабочем месте. Вашему вниманию будет
                                                представлен набор инструкций обязательный
                                                для ознакомления в соответствии с вашей
                                                профессией. Каждый вид инструктажа
                                                (кроме водного), будет заканчиваться
                                                тестированием, в случае не прохождения
                                                Вами тестирования, система будет
                                                возвращать Вас к изучению материала до
                                                момента успешного прохождения
                                                тестирования. Для успешного прохождения
                                                тестирования, внимательно изучайте
                                                материалы инструкций. В случае
                                                возникновения у Вас вопросов, либо
                                                обнаружении сбоев работы системы
                                                обратитесь по телефону 89293812214

                              </div>
                          </div>
                        </td>
                      </tr>
                    <!-- Hi end-->

                    <!-- Report_alert  -->
                    %local_alert%
                    <!-- Report_alert end-->



                    <!-- Report_bailees  -->
                    %report_bailees%
                    <!-- Report_bailees end-->

                      <!-- Report_dir  -->
                      %report_dir%
                    <!-- Report_dir end-->

                    <!-- inst_report_mail -->
                    %inst_report_mail%
                    <!-- inst_report_mail end-->

                     <!-- Login  -->
                     %login%
                    <!-- Login end-->



                    <!-- Footer -->
                    <tr>
                        <td style="font-family:Merriweather,Charter,Georgia,serif;padding-top:25px;padding-bottom:25px;padding-right:50px;padding-left:50px;background-color:#353942;">
                          <table width="150" cellpadding="0" cellspacing="0" align="left" valign="middle" style="border-collapse:collapse;">
                            <tbody><tr>
                              <td style="font-family:Merriweather,Charter,Georgia,serif;text-align:left;">

                              </td>
                            </tr>
                          </tbody></table>
                          <table width="100%" cellpadding="0" cellspacing="0" align="right" valign="middle" style="border-collapse:collapse;font-size:14px;text-align:right;">
                            <tbody><tr>
                              <td style="font-family:Merriweather,Charter,Georgia,serif;text-align:right;">
                                <span style="color:#ffffff;">Заходите к нам </span><a href="https://laborpro.ru" style="font-family:Merriweather,Charter,Georgia,serif;text-decoration:underline;color:#ffffff; text-decoration: none;" target="_blank" data-vdir-href="https://laborpro.ru" data-orig-href="https://laborpro.ru" class="daria-goto-anchor" rel="noopener noreferrer">LaborPro.ru</a>
                              </td>
                            </tr>
                          </tbody></table>
                        </td>
                      </tr>
                      <!-- Footer end-->
                </tbody></table>
              </td>
            </tr>
            <tr><td><span style="display:none;"><a href="#" style="font-family:Merriweather,Charter,Georgia,serif;color:#007dcc;text-decoration:underline;" target="_blank" data-vdir-href="#" data-orig-href="#" class="daria-goto-anchor" rel="noopener noreferrer">Unsubscribe</a></span>
          </td></tr></tbody></table>
        </td>
      </tr>
    </tbody></table>
HERE;



$local_alert_mail ='<tr>
                        <td style="font-family:Merriweather,Charter,Georgia,serif;padding-top:30px;padding-bottom:30px;padding-right:0;padding-left:0;text-align:center;background-color:#294a6d;">
                          <h2 style=" font-family: Merriweather,Charter,Georgia,serif;
                                          font-weight: bold;
                                          font-size: 24px;
                                          margin-top: 0;
                                          margin-bottom: 10px;
                                          color: #ffffff;
                                          margin: 0 auto;">Сегодня надо обработать следующие уведомления:</h2>
                        </td>
                      </tr>
                      <tr>
                        <td style=" font-family:Merriweather,Charter,Georgia,serif;padding-top:20px;padding-bottom:20px;padding-right:10%;padding-left:10%;background-color:#ffffff;">
                          <div style="font-family:Merriweather,Charter,Georgia,serif;margin-top:0;font-size:16px;line-height:25px;text-align:left;color:#777777;">

                                %text%
                              </div>
                          </div>
                        </td>
                      </tr>';

$report_bailees = '<tr>
                        <td style="font-family:Merriweather,Charter,Georgia,serif;padding-top:30px;padding-bottom:30px;padding-right:0;padding-left:0;text-align:center;background-color:#5cad69;">
                          <h2 style=" font-family: Merriweather,Charter,Georgia,serif;
                                          font-weight: bold;
                                          font-size: 24px;
                                          margin-top: 0;
                                          margin-bottom: 10px;
                                          color: #ffffff;
                                          margin: 0 auto;">Вам надо расписаться в документах следующих сотрудников:</h2>
                        </td>
                      </tr>
                      <tr>
                        <td style=" font-family:Merriweather,Charter,Georgia,serif;padding-top:20px;padding-bottom:20px;padding-right:10%;padding-left:10%;background-color:#ffffff;">
                          <div style="font-family:Merriweather,Charter,Georgia,serif;margin-top:0;font-size:16px;line-height:25px;text-align:left;color:#777777  ;">
                                             %text%
                              </div>
                          </div>
                        </td>
                      </tr>';

 $report_dir_mail = '<tr>
                          <td style="font-family:Merriweather,Charter,Georgia,serif;padding-top:30px;padding-bottom:30px;padding-right:0;padding-left:0;text-align:center;background-color:#b65959;">
                          <h2 style=" font-family: Merriweather,Charter,Georgia,serif;
                                          font-weight: bold;
                                          font-size: 24px;
                                          margin-top: 0;
                                          margin-bottom: 10px;
                                          color: #ffffff;
                                          margin: 0 auto;">Отчёт по "%dir%" :</h2>
                           </td>
                        </tr>

                      <tr>
                        <td style=" font-family:Merriweather,Charter,Georgia,serif;padding-top:20px;padding-bottom:20px;padding-left: calc(50% - 160px);background-color:#ffffff;">
                          <div style="font-family:Merriweather,Charter,Georgia,serif;margin-top:0;font-size:16px;line-height:25px;text-align:left;color:#777777  ;">
                                    %text%
                              </div>
                          </div>
                        </td>
                      </tr>';

$login_mail = '<tr>
                          <td style="font-family:Merriweather,Charter,Georgia,serif;padding-top:30px;padding-bottom:30px;padding-right:0;padding-left:0;text-align:center;background-color:#1d6c69;">
                          <h2 style=" font-family: Merriweather,Charter,Georgia,serif;
                                          font-weight: bold;
                                          font-size: 24px;
                                          margin-top: 0;
                                          margin-bottom: 10px;
                                          color: #ffffff;
                                          margin: 0 auto;">Для входа используйте:</h2>
                           </td>
                        </tr>

                      <tr>
                        <td style=" font-family:Merriweather,Charter,Georgia,serif;padding-top:20px;padding-bottom:20px;padding-right:10%;padding-left:10%;background-color:#ffffff;">
                          <div style="font-family:Merriweather,Charter,Georgia,serif;margin-top:0;margin-bottom:25px;font-size:16px;line-height:25px;text-align:left;color:#777777  ;">

                                    %text%
                                    <br>
                                    <span>Перейдите на сайт</span>
                                    <br>
                                    <a href="%link%"><span style="color:#000000;font-weight:700;">Laborpro.ru</span></span></a>


                              </div>
                          </div>
                        </td>
                      </tr>

                      <tr>
                        <td style=" font-family:Merriweather,Charter,Georgia,serif;padding-top:20px;padding-bottom:20px; text-align: center;background-color:#ffffff;">
                          <div style="font-family:Merriweather,Charter,Georgia,serif;margin-top:0;margin-bottom:25px;font-size:16px;line-height:25px;text-align:left;color:#777777; text-align: center;">


                                    <a href="%link%" style="border-radius:10px;text-decoration:none;color:#000000;font-family:Arial,sans-serif;font-size:22px;text-transform:uppercase;background:#FFE74F;margin:0px;padding:20px 40px;"><span style="color:#000000;"><span style="color:#000000;font-weight:700;">Перейти в систему</span></span></a>

                              </div>
                          </div>
                        </td>
                      </tr>';


$inst_report_mail ='<tr>
                          <td style="font-family:Merriweather,Charter,Georgia,serif;padding-top:30px;padding-bottom:30px;padding-right:0;padding-left:0;text-align:center;background-color:#665b7a;">
                          <h2 style=" font-family: Merriweather,Charter,Georgia,serif;
                                          font-weight: bold;
                                          font-size: 24px;
                                          margin-top: 0;
                                          margin-bottom: 10px;
                                          color: #ffffff;
                                          margin: 0 auto;">Вы не прошли следующие инструктажи: :</h2>
                           </td>
                        </tr>

                      <tr>
                        <td style=" font-family:Merriweather,Charter,Georgia,serif;padding-top:20px;padding-bottom:20px;padding-right:10%;padding-left:10%;background-color:#ffffff;">
                          <div style="font-family:Merriweather,Charter,Georgia,serif;margin-top:0;font-size:16px;line-height:25px;text-align:left;color:#777777  ;">

                          %text%

                              </div>
                          </div>
                        </td>
                      </tr>';

$regisrt_temp_mail =<<< HERE
<table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;width:100%;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;background-color:#f5f3eb;">
      <tbody><tr>
        <td align="center" style="font-family:Merriweather,Charter,Georgia,serif;">
          <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;width:100%;margin-top:0;margin-bottom:0;margin-right:0;margin-left:0;padding-top:0;padding-bottom:0;padding-right:0;padding-left:0;">
            <tbody>

            <tr>
              <td width="100%" cellpadding="0" cellspacing="0" style="font-family:Merriweather,Charter,Georgia,serif;">
                <table align="center" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;background-color:#ffffff;">

                      <tbody>
                      <!-- Header -->
                      <tr>
                        <td style="font-family:Merriweather,Charter,Georgia,serif;padding-top:30px;padding-bottom:30px;padding-right:0;padding-left:0;text-align:center;background-color:#ffde00;">
                          <h2 style=" font-family: monospace;
                                          font-weight: bold;
                                          font-size: 28px;
                                          margin-top: 0;
                                          margin-bottom: 10px;
                                          color: #333333;
                                          margin: 0 auto;">Labor<b>Pro</b></h2>
                        </td>
                      </tr>
                      <!-- Header end -->
                      <!-- Hi -->


                      <tr>
                        <td style=" font-family:Merriweather,Charter,Georgia,serif;padding-top:20px;padding-bottom:20px;padding-right:10%;padding-left:10%;background-color:#ffffff;">
                          <div style="font-family:Merriweather,Charter,Georgia,serif;margin-top:0;font-size:16px;line-height:25px;text-align:left;color:#777777  ;">
                                            <h2>Здравствуйте %fio%,</h2>
                                             Вы успешно
                                                авторизовались в системе LaborPRO. Данная
                                                система поможет Вам ознакомиться с
                                                материалами   по безопасности на вашем
                                                рабочем месте. Вашему вниманию будет
                                                представлен набор инструкций обязательный
                                                для ознакомления в соответствии с вашей
                                                профессией. Каждый вид инструктажа
                                                (кроме водного), будет заканчиваться
                                                тестированием, в случае не прохождения
                                                Вами тестирования, система будет
                                                возвращать Вас к изучению материала до
                                                момента успешного прохождения
                                                тестирования. Для успешного прохождения
                                                тестирования, внимательно изучайте
                                                материалы инструкций. В случае
                                                возникновения у Вас вопросов, либо
                                                обнаружении сбоев работы системы
                                                обратитесь по телефону 89293812214

                              </div>
                          </div>
                        </td>
                      </tr>
                    <!-- Hi end-->




                     <!-- Login  -->
                       <tr>
                          <td style="font-family:Merriweather,Charter,Georgia,serif;padding-top:30px;padding-bottom:30px;padding-right:0;padding-left:0;text-align:center;background-color:#1d6c69;">
                          <h2 style=" font-family: Merriweather,Charter,Georgia,serif;
                                          font-weight: bold;
                                          font-size: 24px;
                                          margin-top: 0;
                                          margin-bottom: 10px;
                                          color: #ffffff;
                                          margin: 0 auto;">Для входа используйте:</h2>
                           </td>
                        </tr>

                      <tr>
                        <td style=" font-family:Merriweather,Charter,Georgia,serif;padding-top:20px;padding-bottom:20px;padding-right:10%;padding-left:10%;background-color:#ffffff;">
                          <div style="font-family:Merriweather,Charter,Georgia,serif;margin-top:0;margin-bottom:25px;font-size:16px;line-height:25px;text-align:left;color:#777777  ;">


                                              Логин - %login% <br> пароль - %pass%</b><br>
                              </div>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td style=" font-family:Merriweather,Charter,Georgia,serif;padding-top:20px;padding-bottom:20px;padding-right:10%;padding-left:10%;background-color:#ffffff;">
                          <div style="font-family:Merriweather,Charter,Georgia,serif;margin-top:0;margin-bottom:25px;font-size:16px;line-height:25px;text-align:left;color:#777777  ;">


                                    <a href="%link%" style="border-radius:10px;text-decoration:none;color:#000000;font-family:Arial,sans-serif;font-size:22px;text-transform:uppercase;background:#FFE74F;margin:0px;padding:20px 40px;"><span style="color:#000000;"><span style="color:#000000;font-weight:700;">Перейдите на сайт</span></span></a>

                              </div>
                          </div>
                        </td>
                      </tr>
                    <!-- Login end-->



                    <!-- Footer -->
                    <tr>
                        <td style="font-family:Merriweather,Charter,Georgia,serif;padding-top:25px;padding-bottom:25px;padding-right:50px;padding-left:50px;background-color:#ffde00;">
                          <table width="150" cellpadding="0" cellspacing="0" align="left" valign="middle" style="border-collapse:collapse;">
                            <tbody><tr>
                              <td style="font-family:Merriweather,Charter,Georgia,serif;text-align:left;">

                              </td>
                            </tr>
                          </tbody></table>
                          <table width="100%" cellpadding="0" cellspacing="0" align="right" valign="middle" style="border-collapse:collapse;font-size:14px;text-align:right;">
                            <tbody><tr>
                              <td style="font-family:Merriweather,Charter,Georgia,serif;text-align:right;">
                                <span>Заходите к нам </span><a href="https://laborpro.ru%link%" style="font-family:Merriweather,Charter,Georgia,serif;text-decoration:underline;color:#333333; text-decoration: none;" target="_blank" data-vdir-href="https://laborpro.ru" data-orig-href="https://laborpro.ru" class="daria-goto-anchor" rel="noopener noreferrer">LaborPro.ru</a>
                              </td>
                            </tr>
                          </tbody></table>
                        </td>
                      </tr>
                      <!-- Footer end-->
                </tbody></table>
              </td>
            </tr>
            <tr><td><span style="display:none;"><a href="#" style="font-family:Merriweather,Charter,Georgia,serif;color:#007dcc;text-decoration:underline;" target="_blank" data-vdir-href="#" data-orig-href="#" class="daria-goto-anchor" rel="noopener noreferrer">Unsubscribe</a></span>
          </td></tr></tbody></table>
        </td>
      </tr>
    </tbody></table>
HERE;
