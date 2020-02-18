<?php

@include __DIR__ . DS . 'secrets' . DS . 'credentials.php';
require_once('mailFunctions.php');

return [
    'ssl' => true,

    'cache.pages.active' => true,
    'cache.pages.ignore' => function ($page) {
        return $page->no_cache()->bool();
    },

    'sitemap.ignore' => [
        'error'
    ],

    'languages' => false,
    'languages.detect' => false,

    'checkoutPage' => '/shop/checkout',
    'cartPage' => '/shop/cart',
    'ww.merx.currency' => 'EUR',
    'ww.merx.currencySymbol' => '€',
    'ww.merx.email' => 'bonjour@maisondeseditions.fr',
    'ww.merx.ordersPage' => 'test-orders',
    'ww.merx.successPage' => 'success',    
    'ww.merx.paypal.applicationContext' => [
        'brand_name' => 'Maison des éditions',
    ],
    
    'thumbs' => [
        'quality' => 85,
        'driver' => 'im',
        'srcsets' => [
            'default' => [300, 800, 1024, 1536],
            'cover' => [800, 1024, 1536, 2048],
            'listitem' => [
              '300w' => [
                  'width' => 300,
                  'height' => 170,
                  'crop' => 'center'
              ],
              '800w' => [
                  'width' => 800,
                  'height' => 450,
                  'crop' => 'center'
              ],
              '1024w' => [
                  'width' => 1024,
                  'height' => 576,
                  'crop' => 'center'
              ],
              '1536w' => [
                  'width' => 1536,
                  'height' => 864,
                  'crop' => 'center'
              ]
            ]
        ]
    ],

    


    'cache' => [
        'pages' => [
            'active' => true,
            'ignore' => function ($page) {
                // only cache product and legal pages
                if (in_array((string)$page->intendedTemplate(), ['checkout'])) {
                    return false;
                }
                return true;
            },
        ]
    ],

    'routes' => [

        // add to cart
        [
            'method' => 'post',
            'pattern' => '(:all)/shop-api/add-to-cart',
            'action' => function () {
                try {
                    $data = kirby()->request()->data();

                    // variantes obligatoires
                    $variant = page( $data['id'] )->variants()->toStructure()->nth($data['variant']);
                    
                    merx()->cart()->add([
                        'id' => $data['id'],
                        'variant' => $data['variant'],
                        'price' => $variant->price()->float()
                    ]);
                    
                    return [
                        'status' => 201,
                        'redirect' => option('checkoutPage'),
                    ];
                } catch (Kirby\Exception\Exception $ex) {
                    return $ex->toArray();
                }
            },
        ],

        // client secret
        [
            'pattern' => '(:all)/shop-api/get-client-secret',
            'action' => function () {
                $merx = merx();
                $cart = $merx->cart();
                $paymentIntent = $cart->getStripePaymentIntent();
                kirby()->session()->set('ww.site.paymentIntentId', $paymentIntent->id);
                die($paymentIntent);
                return [
                    'clientSecret' => $paymentIntent->client_secret,
                ];
            },
        ],

        // update cart item
        [
            'method' => 'post',
            'pattern' => '(:all)/shop-api/update-cart-item',
            'action' => function () {
                try {
                    $data = kirby()->request()->data();
                    $cart = merx()->cart()->update([
                        [
                            'id' => $data['id'],
                            'quantity' => (float)($data['quantity'] ?? 1),
                        ],
                    ]);
                    
                    $data = [
                        'items' => $cart->getFormattedItems(),
                        'tax' => formatPrice($cart->getTax()),
                        'sum' => formatPrice($cart->getSum()),
                    ];
                    if ($cart->isEmpty()) {
                        $data['error'] = "Whoops";//I18n::translate('error.merx.checkout.emptycart');
                    }
                    return [
                        'status' => 200,
                        'data' => $data,
                    ];
                } catch (Kirby\Exception\Exception $ex) {
                    return $ex->toArray();
                }
            }
        ],

        // // shipping
        // [
        //     'method' => 'post',
        //     'pattern' => '(:all)/shop-api/shipping',
        //     'action' => function () {
        //         try {
        //             $cart = merx()->cart();
        //             $data = $_POST;

        //             //  ajout shipping price
        //             $sum = $cart->getSum();
        //             $weight = 0.0;
        //             foreach ($cart->data() as $item) {
        //                 if(array_key_exists("variant", $item)){
        //                     $variant = page( $item['id'] )->variants()->toStructure()->nth($item['variant']);                    
        //                     $item_weight = $variant->weight()->int();
        //                     $weight += (float)$item['quantity'] * $item_weight;
        //                 }
        //             }

        //             $shipping_price = 0.0;

        //             if ($weight > 0 && $weight <= 20){
        //                 $shipping_price = 2;
        //             } elseif ($weight > 20 && $weight <= 250){
        //                 $shipping_price = 3;
        //             } elseif ($weight > 250 && $weight <= 500){
        //                 $shipping_price = 5;
        //             } elseif ($weight > 500 && $weight <= 3000){
        //                 $shipping_price = 8;
        //             } elseif ($weight > 3000){
        //                 $shipping_price = 10.0;
        //             } 

        //             $data = array_merge($data, [
        //                 'badaboum' => "badaboum",
        //             ]);

        //             var_dump($data);
                    
        //             return [
        //                 'status' => 201,
        //                 'data' => $data,
        //                 'shipping_price' => $shipping_price,
        //                 'redirect' => option('checkoutPage'),
        //             ];
        //         } catch (Kirby\Exception\Exception $ex) {
        //             return $ex->toArray();
        //         }
        //     }
        // ],


        // submit
        [
            'method' => 'post',
            'pattern' => '(:all)/shop-api/submit',
            'action' => function () {
                try {
                    $data = $_POST;
                    $paymentIntentId = kirby()->session()->get('ww.site.paymentIntentId', '');
                    $data = array_merge($data, [
                        'stripePaymentIntentId' => (string)$paymentIntentId,
                    ]);
                    $redirect = merx()->initializePayment($data);
                    return [
                        'status' => 201,
                        'redirect' => url($redirect),
                    ];
                } catch (Kirby\Exception\Exception $ex) {
                    return $ex->toArray();
                }
            }
        ]
    ],

    'hooks' => [
        'ww.merx.cart' => function ($cart) {
            if ($cart->count() > 0) {
                $cart->remove('shop/shipping');
                $cart->remove('shop/discount');
                $sum = $cart->getSum();

                $weight = 0.0;
                foreach ($cart->data() as $item) {
                    $variant = page( $item['id'] )->variants()->toStructure()->nth($item['variant']);                    
                    $item_weight = $variant->weight()->int();
                    $weight += (float)$item['quantity'] * $item_weight;
                }

                $shipping_price = 0.0;

                if ($weight > 0 && $weight <= 20){
                    $shipping_price = 2;
                } elseif ($weight > 20 && $weight <= 250){
                    $shipping_price = 3;
                } elseif ($weight > 250 && $weight <= 500){
                    $shipping_price = 5;
                } elseif ($weight > 500 && $weight <= 3000){
                    $shipping_price = 8;
                } elseif ($weight > 3000){
                    $shipping_price = 10.0;
                } 

                if ($sum > 0){
                    $cart->add([
                        'id' => 'shop/shipping',
                        'price' => (float)(string)$shipping_price
                    ]);
                }
            }
        },
        'page.changeStatus:after' => function ($newPage, $oldPage) {
            if ((string)$newPage->intendedTemplate() === 'order' && $newPage->isListed()) {
                $kirbyLogger = kirbyLog("page.changeStatus.after.log");
                $logArray = $newPage->toArray();
                $kirbyLogger->log("Yo", "debug", $logArray);
                sendConfirmationMail($newPage);
                sendNewOrderToAdmin($newPage);
            }
        },

        'page.update:after' => function ($newPage, $oldPage) {
            if ((string)$newPage->intendedTemplate() === 'event') {
                $kirbyLogger = kirbyLog("event.changeStatus.after.log");
                $logArray = $newPage->toArray();
                $kirbyLogger->log("Yo", "debug", $logArray);
                sendNewConfirmationMail($newPage);
            }
        },

        'page.update:after' => function ($newPage, $oldPage) {
            if ((string)$newPage->intendedTemplate() === 'order' && $newPage->isListed()) {
                if ($newPage->shipped()->toBool() !== $oldPage->shipped()->toBool()) {
                    if ($newPage->shipped()->isTrue()) {
                        kirby()->impersonate('kirby');
                        $newPage = $newPage->update([
                            'shippingDate' => time(),
                        ])->save();
                        sendShippedMail($newPage);
                    } else {
                        $newPage->update([
                            'shippingDate' => '',
                        ]);
                    }
                }
                if ($newPage->paymentComplete()->toBool() !== $oldPage->paymentComplete()->toBool()) {
                    if ($newPage->paymentComplete()->isTrue()) {
                        kirby()->impersonate('kirby');
                        $newPage = $newPage->update([
                            'payedDate' => time(),
                        ]);
                        if ((string)$newPage->paymentMethod() === 'invoice') {
                            sendPayedMail($newPage);
                        }
                    } else {
                        $newPage->update([
                            'payedDate' => '',
                        ]);
                    }
                }
            }
        },
    ]
];
