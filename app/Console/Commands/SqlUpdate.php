<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SqlUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gateway:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        $checkFiles = file_exists('assets/sqlAdded.txt');
        if (!$checkFiles) {
            \Illuminate\Support\Facades\DB::statement("INSERT INTO `gateways` (`id`, `code`, `name`, `parameters`, `currencies`, `extra_parameters`, `currency`, `symbol`, `min_amount`, `max_amount`, `percentage_charge`, `fixed_charge`, `convention_rate`, `sort_by`, `image`, `status`, `note`, `created_at`, `updated_at`) VALUES
(26, 'midtrans', 'Midtrans', '{\"client_key\": \"\",\"server_key\": \"\"}\r\n', '{\"0\":{\"IDR\":\"IDR\"}}', '{\"payment_notification_url\":\"ipn\", \"finish redirect_url\":\"ipn\", \"unfinish redirect_url\":\"failed\",\"error redirect_url\":\"failed\"}', 'IDR', 'IDR', '1.00000000', '10000.00000000', '0.0000', '0.05000000', '14835.20000000', 7, '63c0045a7adae1673528410.png', 1, '', '2020-09-09 15:05:02', '2023-01-12 01:01:35'),
(27, 'peachpayments', 'peachpayments', '{\"Authorization_Bearer\":\"OGE4Mjk0MTc0ZTczNWQwYzAxNGU3OGNmMjY2YjE3OTR8cXl5ZkhDTjgzZQ==\",\"Entity_ID\":\"\",\"Recur_Channel\":\"\"}', '{\"0\":{\"AED\":\"AED\",\"AFA\":\"AFA\",\"AMD\":\"AMD\",\"ANG\":\"ANG\",\"AOA\":\"AOA\",\"ARS\":\"ARS\",\"AUD\":\"AUD\",\"AWG\":\"AWG\",\"AZM\":\"AZM\",\"BAM\":\"BAM\",\"BBD\":\"BBD\",\"BDT\":\"BDT\",\"BGN\":\"BGN\",\"BHD\":\"BHD\",\"BIF\":\"BIF\",\"BMD\":\"BMD\",\"BND\":\"BND\",\"BOB\":\"BOB\",\"BRL\":\"BRL\",\"BSD\":\"BSD\",\"BTN\":\"BTN\",\"BWP\":\"BWP\",\"BYR\":\"BYR\",\"BZD\":\"BZD\",\"CAD\":\"CAD\",\"CDF\":\"CDF\",\"CHF\":\"CHF\",\"CLP\":\"CLP\",\"CNY\":\"CNY\",\"COP\":\"COP\",\"CRC\":\"CRC\",\"CUP\":\"CUP\",\"CVE\":\"CVE\",\"CYP\":\"CYP\",\"CZK\":\"CZK\",\"DJF\":\"DJF\",\"DKK\":\"DKK\",\"DOP\":\"DOP\",\"DZD\":\"DZD\",\"EEK\":\"EEK\",\"EGP\":\"EGP\",\"ERN\":\"ERN\",\"ETB\":\"ETB\",\"EUR\":\"EUR\",\"FJD\":\"FJD\",\"FKP\":\"FKP\",\"GBP\":\"GBP\",\"GEL\":\"GEL\",\"GGP\":\"GGP\",\"GHC\":\"GHC\",\"GIP\":\"GIP\",\"GMD\":\"GMD\",\"GNF\":\"GNF\",\"GTQ\":\"GTQ\",\"GYD\":\"GYD\",\"HKD\":\"HKD\",\"HNL\":\"HNL\",\"HRK\":\"HRK\",\"HTG\":\"HTG\",\"HUF\":\"HUF\",\"IDR\":\"IDR\",\"ILS\":\"ILS\",\"IMP\":\"IMP\",\"INR\":\"INR\",\"IQD\":\"IQD\",\"IRR\":\"IRR\",\"ISK\":\"ISK\",\"JEP\":\"JEP\",\"JMD\":\"JMD\",\"JOD\":\"JOD\",\"JPY\":\"JPY\",\"KES\":\"KES\",\"KGS\":\"KGS\",\"KHR\":\"KHR\",\"KMF\":\"KMF\",\"KPW\":\"KPW\",\"KRW\":\"KRW\",\"KWD\":\"KWD\",\"KYD\":\"KYD\",\"KZT\":\"KZT\",\"LAK\":\"LAK\",\"LBP\":\"LBP\",\"LKR\":\"LKR\",\"LRD\":\"LRD\",\"LSL\":\"LSL\",\"LTL\":\"LTL\",\"LVL\":\"LVL\",\"LYD\":\"LYD\",\"MAD\":\"MAD\",\"MDL\":\"MDL\",\"MGA\":\"MGA\",\"MKD\":\"MKD\",\"MMK\":\"MMK\",\"MNT\":\"MNT\",\"MOP\":\"MOP\",\"MRO\":\"MRO\",\"MTL\":\"MTL\",\"MUR\":\"MUR\",\"MVR\":\"MVR\",\"MWK\":\"MWK\",\"MXN\":\"MXN\",\"MYR\":\"MYR\",\"MZM\":\"MZM\",\"NAD\":\"NAD\",\"NGN\":\"NGN\",\"NIO\":\"NIO\",\"NOK\":\"NOK\",\"NPR\":\"NPR\",\"NZD\":\"NZD\",\"OMR\":\"OMR\",\"PAB\":\"PAB\",\"PEN\":\"PEN\",\"PGK\":\"PGK\",\"PHP\":\"PHP\",\"PKR\":\"PKR\",\"PLN\":\"PLN\",\"PTS\":\"PTS\",\"PYG\":\"PYG\",\"QAR\":\"QAR\",\"RON\":\"RON\",\"RUB\":\"RUB\",\"RWF\":\"RWF\",\"SAR\":\"SAR\",\"SBD\":\"SBD\",\"SCR\":\"SCR\",\"SDD\":\"SDD\",\"SEK\":\"SEK\",\"SGD\":\"SGD\",\"SHP\":\"SHP\",\"SIT\":\"SIT\",\"SKK\":\"SKK\",\"SLL\":\"SLL\",\"SOS\":\"SOS\",\"SPL\":\"SPL\",\"SRD\":\"SRD\",\"STD\":\"STD\",\"SVC\":\"SVC\",\"SYP\":\"SYP\",\"SZL\":\"SZL\",\"THB\":\"THB\",\"TJS\":\"TJS\",\"TMM\":\"TMM\",\"TND\":\"TND\",\"TOP\":\"TOP\",\"TRL\":\"TRL\",\"TRY\":\"TRY\",\"TTD\":\"TTD\",\"TVD\":\"TVD\",\"TWD\":\"TWD\",\"TZS\":\"TZS\",\"UAH\":\"UAH\",\"UGX\":\"UGX\",\"USD\":\"USD\",\"UYU\":\"UYU\",\"UZS\":\"UZS\",\"VEF\":\"VEF\",\"VND\":\"VND\",\"VUV\":\"VUV\",\"WST\":\"WST\",\"XAF\":\"XAF\",\"XAG\":\"XAG\",\"XAU\":\"XAU\",\"XCD\":\"XCD\",\"XDR\":\"XDR\",\"XOF\":\"XOF\",\"XPD\":\"XPD\",\"XPF\":\"XPF\",\"XPT\":\"XPT\",\"YER\":\"YER\",\"ZAR\":\"ZAR\",\"ZMK\":\"ZMK\",\"ZWD\":\"ZWD\"}}', NULL, 'USD', 'USD', '100.00000000', '10000.00000000', '0.0000', '0.50000000', '1.00000000', 6, '63c0044fd0b051673528399.png', 1, '', '2020-09-09 21:05:02', '2023-01-12 01:01:35'),
(28, 'nowpayments', 'Nowpayments', '{\"api_key\":\"\"}', '{\"1\":{\"BTC\":\"BTC\",\"LTC\":\"LTC\",\"DOGE\":\"DOGE\"}}', '{\"cron\":\"ipn\"}', 'BTC', 'BTC', '10.10000000', '10000.00000000', '0.0000', '0.50000000', '1.00000000', 2, '63c004103f9741673528336.jpg', 1, NULL, '2020-09-09 15:05:02', '2023-01-12 01:01:35'),
(29, 'khalti', 'Khalti Payment', '{\"secret_key\":\"\",\"public_key\":\"\"}', '{\"0\":{\"NPR\":\"NPR\"}}', NULL, 'NPR', 'NPR', '100.00000000', '10000.00000000', '0.0000', '0.00000000', '1.00000000', 4, '63c00427006331673528359.webp', 1, '', '2020-09-09 15:05:02', '2023-01-12 01:01:35'),
(30, 'swagger', 'MAGUA PAY', '{\"MAGUA_PAY_ACCOUNT\":\"EUR-sandbox\",\"MerchantKey\":\"\",\"Secret\":\"\"}', '{\"0\":{\"EUR\":\"EUR\"}}', NULL, 'EUR', 'EUR', '100.00000000', '10000.00000000', '0.0000', '0.00000000', '1.00000000', 3, '63c0041bf3c501673528347.png', 1, '', '2020-09-09 15:05:02', '2023-01-12 01:01:35'),
(31, 'freekassa', 'Free kassa', '{\"merchant_id\": \"8896\",\"merchant_key\": \"\",\"secret_word\": \"\",\"secret_word2\": \"\"}\n', '{\"0\":{\"RUB\":\"RUB\",\"USD\":\"USD\",\"EUR\":\"EUR\",\"UAH\":\"UAH\",\"KZT\":\"KZT\"}}', '{\"ipn_url\":\"ipn\"}', 'RUB', 'RUB', '10.00000000', '10000.00000000', '0.1000', '0.00000000', '1.00000000', 1, '63c003f413d4d1673528308.jpg', 1, NULL, '2020-09-09 15:05:02', '2023-01-12 01:01:35'),
(32, 'konnect', 'Konnect', '{\"api_key\":\"6399ed9208ec811bcda4af6d:9WNA3dfjmDq6ynKb5RsRTYM7dIpq9\",\"receiver_wallet_Id\":\"\"}', '{\"0\":{\"TND\":\"TND\",\"EUR\":\"EUR\",\"USD\":\"USD\"}}', '{\"webhook\":\"ipn\"}', 'USD', 'USD', '1.00000000', '10000.00000000', '0.0000', '0.00000000', '1.00000000', 8, '63c003d84e6b21673528280.png', 1, '', '2020-09-09 15:05:02', '2023-01-12 01:01:35'),
(33, 'mypay', 'Mypay Np', '{\"merchant_username\":\"mjthapa\",\"merchant_api_password\":\"A3T3VHDDFLLJRHN\",\"merchant_id\":\"\",\"api_key\":\"\"}', '{\"0\":{\"NPR\":\"NPR\"}}', NULL, 'NPR', 'NPR', '1.00000000', '100000.00000000', '1.5000', '0.00000000', '1.00000000', 5, '63c004493df081673528393.png', 1, '', '2020-09-09 15:05:02', '2023-01-12 01:01:35'),
(34, 'paythrow', 'PayThrow', '{\"client_id\":\"\", \"client_secret\":\"\"}', '{\"0\":{\"PKR\":\"PKR\",\"USD\":\"USD\"}}', '{\"ipn_url\":\"ipn\"}', 'USD', 'USD', '1.00000000', '10000.00000000', '0.0000', '0.50000000', '157.96000000', 26, '63c00cbd048e81673530557.jpg', 1, NULL, '2020-09-09 21:05:02', '2023-01-12 01:35:57'),
(35, 'imepay', 'IME PAY', '{\"MerchantModule\":\"\",\"MerchantCode\":\"\",\"username\":\"\",\"password\":\"\"}', '{\"0\":{\"NPR\":\"NPR\"}}', NULL, 'NPR', 'NPR', '1.00000000', '100000.00000000', '1.5000', '0.00000000', '1.00000000', 5, '63cb7c952b0e51674280085.png', 1, '', '2020-09-09 15:05:02', '2023-01-20 23:48:05');");

            \Illuminate\Support\Facades\DB::statement("UPDATE `gateways` SET parameters = '{\"MID\":\"\",\"merchant_key\":\"\",\"WEBSITE\":\"\",\"INDUSTRY_TYPE_ID\":\"\",\"CHANNEL_ID\":\"\",\"environment_url\":\"https:\\/\\/securegw-stage.paytm.in\",\"process_transaction_url\":\"https:\\/\\/securegw-stage.paytm.in\\/theia\\/processTransaction\"}' WHERE code ='paytm' ");

            file_put_contents("assets/sqlAdded.txt",time());
        }


        return 0;
    }
}
