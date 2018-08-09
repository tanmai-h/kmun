 <?php 
	require 'req/mailgun-php/vendor/autoload.php';
	use Mailgun\Mailgun;
echo 'sd';
            # Instantiate the client.

            $mgClient = new Mailgun('key-f1f2a5605d9099f7a643d60748d7e18d');
            $domain = "kmun.in";
//$mgClient->setSslEnabled(false);
            # Make the call to the client.
//			$mgClient->setDefaultOption('verify', false);
            $result = $mgClient->sendMessage($domain,
                    array('from'    => 'KMUN Tech <support@kmun.in>',
                            'to'      => 'Fokul<mgokulkumar99@gmail.com>',
                            'subject' => 'Test automated',
                            'text'    => 'Testing from PHP!'));
                            
                            echo 'done';
        ?>