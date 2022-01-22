<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\notif;
use App\Models\notiftype;
use App\Models\tokencloudmsg;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class NotifController extends Controller
{
    public function FunctionName(Request $request)
    {
        $req = new Request();
        $req->code = "priv_selese";
        $req->click_action = "";
        $req->params = [];
        $this->createtoAll($request);

        // $params="invoice,harga";
        // $params=str_split($params);
        // foreach ($params as $key => $value) {
        //     <label>$value</label>
        //     <input name="params[]">
        // }

        // <label>invoice</label>
        //     <input name="params[]">
        // <label>harga</label>
        //     <input name="params[]">
        //     $req->params=$request->params
    }

    public function index(Request $request)
    {
        $notif = notif::with('type')->where('notif_user_id', auth()->user()->id)->paginate(10);
        return response()->json(
            [
                'status' => 'success',
                'msg' => "Success",
                'data' => [
                    'total_items' => $notif->total(),
                    'total_page' => $notif->lastPage(),
                    'current_page' => $notif->currentPage(),
                    'items' => $notif->items()
                ]
            ],
            200
        );
    }

    public function create(Request $request)
    {
        $notiftype = notiftype::firstWhere('notiftypes_code', $request->code);

        if (auth()->user()->role == "trainer") {
            $click_action = "https://legionptapps.com" . $request->click_action;
        } else if (auth()->user()->role == "customer") {
            $click_action = "https://legioncustapps.com" . $request->click_action;
        } else {
            $click_action = $request->click_action;
        }

        $title = $notiftype->notiftypes_title;
        $body = isEmpty($notiftype->notiftypes_params) ? $notiftype->notiftypes_body : vsprintf($notiftype->notiftypes_body, $request->params);
        notif::create([
            'notif_user_id' => auth()->user()->id,
            'notif_type_id' => $notiftype->notiftypes_id,
            'notif_body' => $body,
            'notif_title' => $title,
            'notif_click_action' => $click_action,
        ]);

        $header = array(
            "content-type: application/json",
            "Authorization: key=AAAAfEW--iw:APA91bFXP8FFYMwnitXBDAu8N6U6t5iuiOzxIxcbx8FgK9uYxy3nsBDJENqEZmp2o4kW8SeqldEtX8s1DlRgHEWNy4_623P_pja4iDVdjY3zzqf1Wshaf-rlwIwhAzBa_ICGZ27n9iPg"
        );
        $datajson = [];
        $tokens = tokencloudmsg::where("token_user_id", auth()->user()->id)->get();
        foreach ($tokens as $key => $value) {
            $data = [
                "notification" => [
                    "title" => $title,
                    "body" => $body,
                    "click_action" => $click_action
                ],
                "to" => $value->token_value
            ];
            $json = $this->do_curl("https://fcm.googleapis.com/fcm/send", json_encode($data), $header);
            $datajson[] = json_decode($json);
        }

        return response()->json(
            [
                'status' => 'success',
                'msg' => "Success",
                'data' => $datajson,
                'token' => $tokens,
                'auth()->user()->id' => auth()->user()->id
            ],
            200
        );
    }

    public function create_user_tertentu(Request $request)
    {
        $notiftype = notiftype::firstWhere('notiftypes_code', $request->code);
        $user = User::find($request->user_id);
        if ($user->role == "trainer") {
            $click_action = "https://legionptapps.com" . $request->click_action;
        } else if ($user->role == "customer") {
            $click_action = "https://legioncustapps.com" . $request->click_action;
        } else {
            $click_action = $request->click_action;
        }

        $title = $notiftype->notiftypes_title;
        $body = isEmpty($notiftype->notiftypes_params) ? $notiftype->notiftypes_body : vsprintf($notiftype->notiftypes_body, $request->params);
        notif::create([
            'notif_user_id' => $user->id,
            'notif_type_id' => $notiftype->notiftypes_id,
            'notif_body' => $body,
            'notif_title' => $title,
            'notif_click_action' => $click_action,
        ]);

        $header = array(
            "content-type: application/json",
            "Authorization: key=AAAAfEW--iw:APA91bFXP8FFYMwnitXBDAu8N6U6t5iuiOzxIxcbx8FgK9uYxy3nsBDJENqEZmp2o4kW8SeqldEtX8s1DlRgHEWNy4_623P_pja4iDVdjY3zzqf1Wshaf-rlwIwhAzBa_ICGZ27n9iPg"
        );
        $datajson = [];
        $tokens = tokencloudmsg::where("token_user_id", $user->id)->get();
        foreach ($tokens as $key => $value) {
            $data = [
                "notification" => [
                    "title" => $title,
                    "body" => $body,
                    "click_action" => $click_action
                ],
                "to" => $value->token_value
            ];
            $json = $this->do_curl("https://fcm.googleapis.com/fcm/send", json_encode($data), $header);
            $datajson[] = json_decode($json);
        }

        return response()->json(
            [
                'status' => 'success',
                'msg' => "Success",
                'data' => $datajson,
                'token' => $tokens,
                'auth()->user()->id' => $user->id
            ],
            200
        );
    }

    public function createtoAll(Request $request)
    {
        $to = $request->role;
        $notiftype = notiftype::firstWhere('notiftypes_code', $request->code);

        if ($to == 'all') {
            $users = User::all();
        } else {
            $users = User::where('role', $to)->get();
        }

        $title = $notiftype->notiftypes_title;
        $body = isEmpty($notiftype->notiftypes_params) ? $notiftype->notiftypes_body : vsprintf($notiftype->notiftypes_body, $request->params);

        $datajson = [];
        $header = array(
            "content-type: application/json",
            "Authorization: key=AAAAfEW--iw:APA91bFXP8FFYMwnitXBDAu8N6U6t5iuiOzxIxcbx8FgK9uYxy3nsBDJENqEZmp2o4kW8SeqldEtX8s1DlRgHEWNy4_623P_pja4iDVdjY3zzqf1Wshaf-rlwIwhAzBa_ICGZ27n9iPg"
        );
        foreach ($users as $key => $user) {
            if ($user->role == "trainer") {
                $click_action = "https://legionptapps.com" . $request->click_action;
            } else if ($user->role == "customer") {
                $click_action = "https://legioncustapps.com" . $request->click_action;
            } else {
                $click_action = $request->click_action;
            }

            notif::create([
                'notif_user_id' => $user->id,
                'notif_type_id' => $notiftype->notiftypes_id,
                'notif_body' => $body,
                'notif_title' => $title,
                'notif_click_action' => $click_action,
            ]);

            $tokens = tokencloudmsg::where("token_user_id", $user->id)->get();
            foreach ($tokens as $key => $value) {
                $data = [
                    "notification" => [
                        "title" => $title,
                        "body" => $body,
                        "click_action" => $click_action
                    ],
                    "to" => $value->token_value
                ];
                $json = $this->do_curl("https://fcm.googleapis.com/fcm/send", json_encode($data), $header);
                $datajson[] = json_decode($json);
            }
        }

        return response()->json(
            [
                'status' => 'success',
                'msg' => "Success",
                'data' => $datajson,
            ],
            200
        );
    }

    function do_curl($link, $data = null, $header = null, $location = false)
    {
        $ch = curl_init($link);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_COOKIESESSION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 200);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_USERAGENT, isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '');
        curl_setopt($ch, CURLOPT_REFERER, isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '');
        if (!empty($data)) {
            if (is_array($data)) {
                $data = http_build_query($data);
            }
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, trim($data));
        }
        if (!empty($header)) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        }
        $return = curl_exec($ch);
        if ($location) {
            $return = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        }
        return $return ? $return : "";
    }
}
