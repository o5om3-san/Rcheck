<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Check;

class CheckController extends Controller
{
    public function index() {
        $checks = $this->checked_list();
        return view('check', ['checks' => $checks]);
    }

    // 任意の日付のチェックリスト
    public function list(Request $request) {
        $date = request('date');
        $checks = $this->checked_list2($request);
        return view('check', ['checks' => $checks, 'date' => $date]);
    }

    public function store(Request $request) {
        $check = new Check;
        $check->name = request('name');
        $check->date = date('20y-m-d');
        $check->checked = 1;

        // ユーザが登録されていない
        if ($this->is_wrong_user($check->name)) {
            return view('check', ['status' => 'null_user', 'checks' => $this->checked_list()]);
        }

        DB::beginTransaction();
        try {

            $check->save();
            DB::commit();

            $status = 'success';

        } catch(\Exception $e) {
            // 失敗(登録済みなど)
            DB::rollback();
            $status = 'error';

        }

        return view('check', ['status' => $status, 'checks' => $this->checked_list()]);
    }

    public function checked_list() {
        $checks = DB::table('users')
            ->select('users.name', 'island', 'alphabet', 'checked')
            ->join('checks','users.name','=','checks.name')
            ->where('date', '=', date('20y-m-d'))
            ->get();

        return $checks;
    }

    public function checked_list2(Request $request) {
        $date = request('date');
        $checks = DB::table('users')
            ->select('users.name', 'island', 'alphabet', 'checked')
            ->join('checks','users.name','=','checks.name')
            ->where('date', '=', $date)
            ->get();

        return $checks;
    }

    public function is_wrong_user(string $name) {
        // ユーザが既にUsersテーブルに登録されているか判定
        $checks = DB::table('users')
            ->select('name')
            ->where('name', '=', $name)
            ->get();

        return $checks->isEmpty();
    }

    public function revise(Request $request) {
        $check = new Check;
        $check->name = request('name');
        $check->date = date('20y-m-d');
        $check->checked = 1;

        // ユーザが登録されていない
        if ($this->is_wrong_user($check->name)) {
            return view('check', ['status' => 'null_user', 'checks' => $this->checked_list()]);
        }

        DB::beginTransaction();
        try {

            $check->save();
            DB::commit();

            $status = 'success';

        } catch(\Exception $e) {
            // 失敗(登録済みなど)
            DB::rollback();
            $status = 'error';

        }

        return view('check', ['status' => $status, 'checks' => $this->checked_list()]);
    }
}
