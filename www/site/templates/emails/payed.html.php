<?php
use Wagnerwagner\Merx\Merx;
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
  <title> </title>
  <!--[if !mso]><!-- -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!--<![endif]-->
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style type="text/css">
    #outlook a {
      padding: 0;
    }

    body {
      margin: 0;
      padding: 0;
      -webkit-text-size-adjust: 100%;
      -ms-text-size-adjust: 100%;
    }

    table,
    td {
      border-collapse: collapse;
      mso-table-lspace: 0pt;
      mso-table-rspace: 0pt;
    }

    img {
      border: 0;
      height: auto;
      line-height: 100%;
      outline: none;
      text-decoration: none;
      -ms-interpolation-mode: bicubic;
    }

    p {
      display: block;
      margin: 13px 0;
    }
  </style>
  <!--[if mso]>
        <xml>
        <o:OfficeDocumentSettings>
          <o:AllowPNG/>
          <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
        </xml>
        <![endif]-->
  <!--[if lte mso 11]>
        <style type="text/css">
          .mj-outlook-group-fix { width:100% !important; }
        </style>
        <![endif]-->
  <!--[if !mso]><!-->
  <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500" rel="stylesheet" type="text/css">
  <style type="text/css">
    @import url(https://fonts.googleapis.com/css?family=Work+Sans:400,500);
  </style>
  <!--<![endif]-->           
  <style type="text/css">
    @media only screen and (min-width:480px) {
      .mj-column-per-100 {
        width: 100% !important;
        max-width: 100%;
      }
    }
  </style>
  <style type="text/css">
    @media only screen and (max-width:480px) {
      table.mj-full-width-mobile {
        width: 100% !important;
      }
      td.mj-full-width-mobile {
        width: auto !important;
      }
    }
  </style>
</head>

<body style="background-color:hsl(0, 0%, 98%);">
  <div style="background-color:hsl(0, 0%, 98%);">
    <!--[if mso | IE]>
      <table
         align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600"
      >
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]-->
    <div style="background:white;background-color:white;margin:0px auto;max-width:600px;">
      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:white;background-color:white;width:100%;">
        <tbody>
          <tr>
            <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
              <!--[if mso | IE]>
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                
        <tr>
      
            <td
               class="" style="vertical-align:top;width:600px;"
            >
          <![endif]-->
              <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                  <tr>
                    <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                      <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;">
                        <tbody>
                          <tr>
                            <td style="width:200px;"> <img alt="Maison des éditions" height="80" src="<?= $site->images()->template('logo')->first()->url() ?>" style="border:0;display:block;outline:none;text-decoration:none;height:80px;width:100%;font-size:14px;" width="200">                              </td>
                          </tr>
                        </tbody>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                      <div style="font-family:'Work Sans','Helvetica Neue';font-size:14px;line-height:18px;text-align:left;color:#000000;">
                        <?php echo t("hello") ?>,<br> <br>
                        <?php echo tt("email.confirmation.paymentDone", ["date"=>date('d.m.Y', $orderPage->payedDate()->toInt())]) ?>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" style="font-size:0px;padding:10px 25px;padding-top:50px;word-break:break-word;">
                      <div style="font-family:'Work Sans','Helvetica Neue';font-size:14px;font-weight:bold;line-height:1;text-align:left;color:#000000;">
                        <?php echo t("Order preview") ?>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" style="font-size:0px;padding:10px 25px;padding-top:20px;word-break:break-word;">
                      <table cellpadding="0" cellspacing="0" width="100%" border="0" style="color:#000000;font-family:'Work Sans','Helvetica Neue';font-size:14px;line-height:18px;table-layout:auto;width:100%;border:none;">
                        <tr>
                          <th class="th" style="text-align: left; text-transform: uppercase; font-size: 14px; font-weight: 400; padding-bottom: 20px; padding-right: 5px;" align="left">
                            <?php echo t("email.confirmation.product") ?>
                          </th>
                          <th class="th" style="text-transform: uppercase; font-size: 14px; font-weight: 400; padding-bottom: 20px; padding-right: 5px; text-align: center;" align="center">
                            <?php echo t("email.confirmation.q") ?>
                          </th>
                          <th class="th" style="text-transform: uppercase; font-size: 14px; font-weight: 400; padding-bottom: 20px; padding-right: 5px; text-align: right;" align="right">
                            <?php echo t("email.confirmation.unitPrice") ?>
                          </th>
                          <th class="th" style="text-transform: uppercase; font-size: 14px; font-weight: 400; padding-bottom: 20px; text-align: right;" align="right">
                            <?php echo t("email.confirmation.total") ?>
                          </th>
                        </tr>
                        <?php foreach($orderPage->cart() as $item): ?>
                        <?php
          $itemPage = page($item['id']);
        ?>
                          <tr>
                            <td style="padding-bottom: 20px">
                              <?php if ($itemPage): ?> <strong><?= $itemPage->title(); ?></strong>
                              <?php else: ?> <strong><?= $item['title'] ?></strong>
                              <?php endif; ?> </td>
                            <td style="padding-bottom: 20px; text-align: center;">
                              <?= $item['quantity'] ?>
                            </td>
                            <td style="padding-bottom: 20px; text-align: right; white-space: no-wrap">
                              <?= Merx::formatPrice($item['price']) ?>
                            </td>
                            <td style="padding-bottom: 20px; text-align: right; white-space: no-wrap">
                              <?= Merx::formatPrice($item['sum']) ?>
                            </td>
                          </tr>
                          <?php endforeach; ?>
                          <tr style="border-top: 1px solid black;">
                            <td></td>
                            <td></td>
                            <td style="text-align: right; padding-right: 16px; padding-top: 20px">
                              <?php echo t("email.confirmation.VATIncluded") ?>
                            </td>
                            <td style="text-align: right; padding-top: 20px; white-space: no-wrap">
                              <?= Merx::formatPrice($orderPage->cart()->getTax()) ?>
                            </td>
                          </tr>
                          <tr style="font-weight: 700;">
                            <td></td>
                            <td></td>
                            <td style="text-align: right; padding-right: 16px; padding-top: 5px;">
                              <?php echo t("email.confirmation.total") ?>
                            </td>
                            <td style="text-align: right; padding-top: 5px; white-space: no-wrap">
                              <?= Merx::formatPrice($orderPage->cart()->getSum()) ?>
                            </td>
                          </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </div>
              <!--[if mso | IE]>
            </td>
          
        </tr>
      
                  </table>
                <![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]>
          </td>
        </tr>
      </table>
      
      <table
         align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600"
      >
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]-->
    <div style="background:white;background-color:white;margin:0px auto;max-width:600px;">
      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:white;background-color:white;width:100%;">
        <tbody>
          <tr>
            <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
              <!--[if mso | IE]>
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                
        <tr>
      
            <td
               class="" style="vertical-align:top;width:600px;"
            >
          <![endif]-->
              <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                  <tr>
                    <td align="left" style="font-size:0px;padding:10px 25px;padding-top:50px;word-break:break-word;">
                      <div style="font-family:'Work Sans','Helvetica Neue';font-size:14px;font-weight:bold;line-height:1;text-align:left;color:#000000;">
                        <?php echo t("email.confirmation.billingAddress") ?>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td align="left" style="font-size:0px;padding:10px 25px;padding-top:20px;word-break:break-word;">
                      <div style="font-family:'Work Sans','Helvetica Neue';font-size:14px;line-height:18px;text-align:left;color:#000000;">
                        <?= $orderPage->name() ?><br>
                          <?= $orderPage->street() ?><br>
                            <?= $orderPage->postalCode() ?>
                              <?= $orderPage->city() ?><br>
                                <?= $orderPage->country() ?>
                      </div>
                    </td>
                  </tr>
                </table>
              </div>
              <!--[if mso | IE]>
            </td>
          
        </tr>
      
                  </table>
                <![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]>
          </td>
        </tr>
      </table>
      
      <table
         align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600"
      >
        <tr>
          <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
      <![endif]-->
    <div style="background:white;background-color:white;margin:0px auto;max-width:600px;">
      <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:white;background-color:white;width:100%;">
        <tbody>
          <tr>
            <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
              <!--[if mso | IE]>
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                
        <tr>
      
            <td
               class="" style="vertical-align:top;width:600px;"
            >
          <![endif]-->
              <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                  <tr>
                    <td align="left" style="font-size:0px;padding:10px 25px;padding-top:20px;word-break:break-word;">
                      <div style="font-family:'Work Sans','Helvetica Neue';font-size:14px;line-height:1;text-align:left;color:#000000;">
                        <a href="<?= $orderPage->url() ?>" style="background-color: black; color: white; padding: 10px 16px; text-decoration: none;">
                          <?php echo t("email.confirmation.shippingAddress") ?>
                        </a>
                      </div>
                    </td>
                  </tr>
                </table>
              </div>
              <!--[if mso | IE]>
            </td>
          
        </tr>
      
                  </table>
                <![endif]-->
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <!--[if mso | IE]>
          </td>
        </tr>
      </table>
      <![endif]-->
  </div>
</body>

</html>