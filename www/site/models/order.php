<?php
use Wagnerwagner\Merx\Merx;


class OrderPage extends OrderPageAbstract {
  public function errors(): array
  {
    $errors = parent::errors();
    if ($this->deliveryAddress()=="useAnotherShippingAddress") {
      $ruleText = ['minLength' => 3, 'maxLength' => 255];
      $rulePostalCode = ['num', 'minLength' => 5, 'maxLength' => 5];
      $errors = array_merge($errors,
        Merx::getFieldError($this->shippingAddressName(), $ruleText),
        Merx::getFieldError($this->shippingAddressStreet(), $ruleText),
        Merx::getFieldError($this->shippingAddressPostalCode(), $rulePostalCode),
        Merx::getFieldError($this->shippingAddressCity(), $ruleText)
      );
    }

    if ($this->legal()->isFalse()) {
      $errors = array_merge($errors, [
        'legal' => [
          'message' => [
            'required' => t('order.legal'),
          ],
        ],
      ]);
    }
    return $errors;
  }


  public function formattedShippingDate(): string
  {
    if ($this->shippingDate()->isNotEmpty()) {
      return date('d.m.Y', $this->shippingDate()->toInt());
    } else {
      return '';
    }
  }

  public function formattedIsShipped(): string
  {
    if ($this->shipped()->bool()) {
      return 'traité' . " — ";
    } else {
      return '';
    }
  }

  public function formattedName(): string
  {
    if ($this->name()->isNotEmpty()) {
      return $this->name() . " — ";
    } else {
      return '';
    }
  }

  public function computeShipping(): string
  {
    if ($this->name()->isNotEmpty()) {
      return $this->name() . " — ";
    } else {
      return '';
    }
  }




  public function paymentMethodString(): string
  {
    $paymentMethod = $this->content()->paymentMethod();
    $paymentMethods = site()->paymentMethods()->toStructure();
    $paymentMethodObject = $paymentMethods->findBy('value', (string)$paymentMethod);
    if ($paymentMethods && $paymentMethodObject) {
      return (string)$paymentMethodObject->text();
    } else {
      return $paymentMethod;
    }
  }

  public function invoiceNumber(): string
  {
    if ($this->num()) {
      return 'MDE-' . $this->invoiceDate()->toDate('Y-m') . "-" . str_pad($this->num(), 3, 0, STR_PAD_LEFT);
    } else {
      return '';
    }
  }
};
