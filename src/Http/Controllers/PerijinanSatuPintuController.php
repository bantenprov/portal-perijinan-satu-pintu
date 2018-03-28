<?php

namespace Bantenprov\PerijinanSatuPintu\Http\Controllers;

/* Require */
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bantenprov\BudgetAbsorption\Facades\PerijinanSatuPintuFacade;

/* Models */
use Bantenprov\PerijinanSatuPintu\Models\Bantenprov\PerijinanSatuPintu\PerijinanSatuPintu;
use Bantenprov\GroupEgovernment\Models\Bantenprov\GroupEgovernment\GroupEgovernment;
use Bantenprov\SectorEgovernment\Models\Bantenprov\SectorEgovernment\SectorEgovernment;
use App\User;

/* Etc */
use Validator;

/**
 * The PerijinanSatuPintuController class.
 *
 * @package Bantenprov\PerijinanSatuPintu
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class PerijinanSatuPintuController extends Controller
{  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $group_egovernmentModel;
    protected $sector_egovernment;
    protected $perijinan_satu_pintu;
    protected $user;

    public function __construct(PerijinanSatuPintu $perijinan_satu_pintu, GroupEgovernment $group_egovernment, SectorEgovernment $sector_egovernment, User $user)
    {
        $this->perijinan_satu_pintu      = $perijinan_satu_pintu;
        $this->group_egovernmentModel    = $group_egovernment;
        $this->sector_egovernment    = $sector_egovernment;
        $this->user             = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->has('sort')) {
            list($sortCol, $sortDir) = explode('|', request()->sort);

            $query = $this->perijinan_satu_pintu->orderBy($sortCol, $sortDir);
        } else {
            $query = $this->perijinan_satu_pintu->orderBy('id', 'asc');
        }

        if ($request->exists('filter')) {
            $query->where(function($q) use($request) {
                $value = "%{$request->filter}%";
                $q->where('label', 'like', $value)
                    ->orWhere('description', 'like', $value);
            });
        }

        $perPage = request()->has('per_page') ? (int) request()->per_page : null;
        $response = $query->with('user')->with('group_egovernment')->with('sector_egovernment')->paginate($perPage);

        return response()->json($response)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $group_egovernment = $this->group_egovernmentModel->all();
        $sector_egovernment = $this->sector_egovernment->all();
        $users = $this->user->all();

        foreach($users as $user){
            array_set($user, 'label', $user->name);
        }

        $response['group_egovernment'] = $group_egovernment;
        $response['sector_egovernment'] = $sector_egovernment;
        $response['user'] = $users;
        $response['status'] = true;

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PerijinanSatuPintu  $perijinan_satu_pintu
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $perijinan_satu_pintu = $this->perijinan_satu_pintu;

        $validator = Validator::make($request->all(), [
            'group_egovernment_id' => 'required',
            'sector_egovernment_id' => 'required',
            'user_id' => 'required',
            'label' => 'required',
            'description' => 'required',
            'link' => 'required'
        ]);

        if($validator->fails()){
            $check = $perijinan_satu_pintu->where('label',$request->label)->whereNull('deleted_at')->count();

            if ($check > 0) {
                $response['message'] = 'Failed, label ' . $request->label . ' already exists';
            } else {
                $perijinan_satu_pintu->group_egovernment_id = $request->input('group_egovernment_id');
                $perijinan_satu_pintu->sector_egovernment_id = $request->input('sector_egovernment_id');
                $perijinan_satu_pintu->user_id = $request->input('user_id');
                $perijinan_satu_pintu->label = $request->input('label');
                $perijinan_satu_pintu->description = $request->input('description');
                $perijinan_satu_pintu->link = $request->input('link');
                $perijinan_satu_pintu->save();

                $response['message'] = 'success';
            }
        } else {
            $perijinan_satu_pintu->group_egovernment_id = $request->input('group_egovernment_id');
            $perijinan_satu_pintu->sector_egovernment_id = $request->input('sector_egovernment_id');
            $perijinan_satu_pintu->user_id = $request->input('user_id');
            $perijinan_satu_pintu->label = $request->input('label');
            $perijinan_satu_pintu->description = $request->input('description');
            $perijinan_satu_pintu->link = $request->input('link');
            $perijinan_satu_pintu->save();
            $response['message'] = 'success';
        }

        $response['status'] = true;

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $perijinan_satu_pintu = $this->perijinan_satu_pintu->findOrFail($id);

        $response['perijinan_satu_pintu'] = $perijinan_satu_pintu;
        $response['group_egovernment'] = $perijinan_satu_pintu->group_egovernment;
        $response['sector_egovernment'] = $perijinan_satu_pintu->sector_egovernment;
        $response['user'] = $perijinan_satu_pintu->user;
        $response['status'] = true;

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PerijinanSatuPintu  $perijinan_satu_pintu
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $perijinan_satu_pintu = $this->perijinan_satu_pintu->findOrFail($id);

        array_set($perijinan_satu_pintu->user, 'label', $perijinan_satu_pintu->user->name);

        $response['perijinan_satu_pintu'] = $perijinan_satu_pintu;
        $response['group_egovernment'] = $perijinan_satu_pintu->group_egovernment;
        $response['sector_egovernment'] = $perijinan_satu_pintu->sector_egovernment;
        $response['user'] = $perijinan_satu_pintu->user;
        $response['status'] = true;

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PerijinanSatuPintu  $perijinan_satu_pintu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $response = array();
        $message  = array();
        
        $perijinan_satu_pintu = $this->perijinan_satu_pintu->findOrFail($id);

            $validator = Validator::make($request->all(), [
                'label' => 'required',
                'description' => 'required',
                'group_egovernment_id' => 'required',
                'sector_egovernment_id' => 'required',
                'user_id' => 'required',
                'link' => 'required'
            ]);

         if($validator->fails()){

                foreach($validator->messages()->getMessages() as $key => $error){
                    foreach($error AS $error_get) {
                        array_push($message, $error_get. "\n");
                    }                
                } 
                $response['message'] = $message;
            } else {
                $perijinan_satu_pintu->label = $request->input('label');
                $perijinan_satu_pintu->description = $request->input('description');
                $perijinan_satu_pintu->group_egovernment_id = $request->input('group_egovernment_id');
                $perijinan_satu_pintu->sector_egovernment_id = $request->input('sector_egovernment_id');
                $perijinan_satu_pintu->user_id = $request->input('user_id');
                $perijinan_satu_pintu->link = $request->input('link');
                $perijinan_satu_pintu->save();

                $response['message'] = 'success';
            }

        $response['status'] = true;

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PerijinanSatuPintu  $perijinan_satu_pintu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $perijinan_satu_pintu = $this->perijinan_satu_pintu->findOrFail($id);

        if ($perijinan_satu_pintu->delete()) {
            $response['status'] = true;
        } else {
            $response['status'] = false;
        }

        return json_encode($response);
    }
}
