<?php
use Wagnerwagner\Merx\Merx;

function sendNewConfirmationMail(OrderPage $orderPage): void
{
  try {

    $kirby->email([
      'from' => option('ww.merx.email'),
      'to' => 'julienbidoret@gmail.com',
      'subject' => 'Votre commande à ' . site()->title(),
      'body'=> 'It\'s great to have you with us',
    ]);


    $email = new Kirby\Cms\Email([
      'from' => option('ww.merx.email'),
      'to' => (string)$orderPage->email(),
      'subject' => 'Votre commande à ' . site()->title(),
      'template' => 'confirmation',
      'data' => [
        'site' => kirby()->site(),
        'orderPage' => $orderPage,
      ],
    ]);
    new Kirby\Email\PHPMailer($email->toArray());
    $logArray = $email->toArray();
    $kirbyLogger = kirbyLog("sendConfirmationMail.log");
    $kirbyLogger->log("sendConfirmationMail error", "debug", $logArray);

    unset($logArray['data']);
    // Merx::createLog($orderPage, 'info', 'Confirmation mail sent', $logArray);
  } catch (Exception $ex) {
    $kirbyLogger = kirbyLog("sendConfirmationMail.log");
    $kirbyLogger->log("sendConfirmationMail error", "badaboum");
    // Merx::createLog($orderPage, 'error', 'Confirmation mail could not be sent to customer', $ex->getMessage());
  }
}

function sendConfirmationMail(OrderPage $orderPage): void
{
  try {
    $email = new Kirby\Cms\Email([
      'from' => option('ww.merx.email'),
      'to' => (string)$orderPage->email(),
      'subject' => 'Votre commande à ' . site()->title(),
      'template' => 'confirmation',
      'data' => [
        'site' => kirby()->site(),
        'orderPage' => $orderPage,
      ],
    ]);
    new Kirby\Email\PHPMailer($email->toArray());
    $logArray = $email->toArray();
    $kirbyLogger = kirbyLog("sendConfirmationMail.log");
    $kirbyLogger->log("sendConfirmationMail error", "debug", $logArray);

    unset($logArray['data']);
    // Merx::createLog($orderPage, 'info', 'Confirmation mail sent', $logArray);
  } catch (Exception $ex) {
    $kirbyLogger = kirbyLog("sendConfirmationMail.log");
    $kirbyLogger->log("sendConfirmationMail error", $ex->getMessage());
    // Merx::createLog($orderPage, 'error', 'Confirmation mail could not be sent to customer', $ex->getMessage());
  }
}

function sendNewOrderToAdmin(OrderPage $orderPage): void
{
  try {
    $email = new Kirby\Cms\Email([
      'from' => option('ww.merx.email'),
      'replyTo' => (string)$orderPage->email(),
      'to' => option('ww.merx.email'),
      'subject' => 'Nouvelle commande ' . (string)$orderPage->name() . ', ' . (string)$orderPage->city() . ' (' . Merx::formatPrice($orderPage->cart()->getSum()) . ')',
      'template' => 'new-order',
      'data' => [
        'site' => kirby()->site(),
        'orderPage' => $orderPage,
      ],
    ]);
    new Kirby\Email\PHPMailer($email->toArray());
    $logArray = $email->toArray();
    unset($logArray['data']);
    // Merx::createLog($orderPage, 'info', 'New order mail to admin sent', $logArray);
  } catch (Exception $ex) {
    // Merx::createLog($orderPage, 'error', 'New order mail could not be sent to admin', $ex->getMessage());
  }
}

function sendShippedMail(OrderPage $orderPage): void
{
  try {
    $email = new Kirby\Cms\Email([
      'from' => option('ww.merx.email'),
      'to' => (string)$orderPage->email(),
      'subject' => 'Votre commande à ' . site()->title() . ' a été envoyée.',
      'template' => 'shipped',
      'data' => [
        'site' => kirby()->site(),
        'orderPage' => $orderPage,
      ],
    ]);
    new Kirby\Email\PHPMailer($email->toArray());
    $logArray = $email->toArray();
    unset($logArray['data']);
    // Merx::createLog($orderPage, 'info', 'Shipping mail sent', $logArray);
  } catch (Exception $ex) {
    // Merx::createLog($orderPage, 'error', 'Shipping mail could not be sent to customer', $ex->getMessage());
  }
}

function sendPayedMail(OrderPage $orderPage): void
{
  try {
    $email = new Kirby\Cms\Email([
      'from' => option('ww.merx.email'),
      'to' => (string)$orderPage->email(),
      'subject' => 'Votre commande à ' . site()->title() . ' a été payée.',
      'template' => 'payed',
      'data' => [
        'site' => kirby()->site(),
        'orderPage' => $orderPage,
      ],
    ]);
    new Kirby\Email\PHPMailer($email->toArray());
    $logArray = $email->toArray();
    unset($logArray['data']);
    // Merx::createLog($orderPage, 'info', 'Payed mail sent', $logArray);
  } catch (Exception $ex) {
    // Merx::createLog($orderPage, 'error', 'Payed mail could not be sent to customer', $ex->getMessage());
  }
}
