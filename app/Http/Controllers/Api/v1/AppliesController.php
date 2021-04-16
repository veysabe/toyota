<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Apply;
use App\Models\Time;
use Illuminate\Http\Request;

class AppliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->body;
        $time = Time::find($data['time']);
        if ($time->booked)
            return [
                'status' => 'error',
                'data' => 'К сожалению, данное время уже занято. Выберите другое.'
            ];



        $apply = new Apply();
        $apply->name = $data['user_data']['name'];
        $apply->last_name = $data['user_data']['last_name'];
        $apply->phone = $data['user_data']['phone'];
        $apply->email = $data['user_data']['email'];
        $apply->time_id = $time->id;
        $apply->save();

        $time->booked = true;
        $time->save();

        if (!$apply) {
            return [
                'status' => 'error',
                'data' => 'Ошибка при создании заявки'
            ];
        }

        return ['status' => 'ok'];
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apply = Apply::find($id);
        $time = $apply->time;
        $time->booked = false;
        $time->save();
        $apply->delete();
        return redirect('/admin');
    }
}
