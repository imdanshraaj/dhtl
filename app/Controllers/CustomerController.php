<?php namespace app\Controllers;

use app\Models\Customer;
use app\Controllers\AuthController;
use Symfony\Component\HttpFoundation\Request;

class CustomerController
{

  public function index()
  {
    $request = Request::createFromGlobals();

    $latitude = $request->request->get('latitude');
    $longitude = $request->request->get('longitude');

    $userId = (new AuthController())->login();
    if(!$userId)
    {
      print_r(json_encode(['status'=>'error','data'=>[],'message'=>'Unauthorized User']));
      die;
    }

    $customers = Customer::selectRaw("
      customers.*,
      (((acos(sin(('.$latitude.'*pi()/180)) * sin((latitude*pi()/180)) + cos(('.$latitude.'*pi()/180)) * cos((latitude*pi()/180)) * cos((('.$longitude.'- longitude) * pi()/180)))) * 180/pi()) * 60 * 1.1515 * 1.609344) as distance
    ")
    ->orderBy('distance','ASC')
    ->get();

    if($customers)
    {
      print_r(json_encode(['status'=>'success', 'data'=>$customers ,'message'=>'Successful']));
          die;
    }
    else
    {
      print_r(json_encode(['status'=>'error','data'=>[],'message'=>'Unable']));
      die;
    }
  }

  public function store()
  {
    $request = Request::createFromGlobals();

    $userId = (new AuthController())->login();
    if(!$userId)
    {
      print_r(json_encode(['status'=>'error','data'=>[],'message'=>'Unauthorized User']));
      die;
    }

    if ($customer = Customer::insert(array(
      'name'=>$request->request->get('name'),
      'email'=>$request->request->get('email'),
      'address'=>$request->request->get('address'),
      'latitude'=>$request->request->get('latitude'),
      'longitude'=>$request->request->get('longitude'),
      'userId'=>$userid
    ))) {
        print_r(json_encode(['status'=>'success','data'=>$customer]));
        die;
    }
  }

  public function edit($id)
  {
    $request = Request::createFromGlobals();

    $userId = (new AuthController())->login();
    if(!$userId)
    {
      print_r(json_encode(['status'=>'error','data'=>[],'message'=>'Unauthorized User']));
      die;
    }

    $customer = Customer::where('id',$id)->first();

      if($customer->update(array(
        'name'=>$request->request->get('name'),
        'email'=>$request->request->get('email'),
        'address'=>$request->request->get('address'),
        'latitude'=>$request->request->get('latitude'),
        'longitude'=>$request->request->get('longitude'),
        'userId'=>$userid
      ))) {
          print_r(json_encode(['status'=>'success','data'=>$customer]));
          die;
      }

    print_r(json_encode(['status'=>'error','data'=>[],'message'=>'Unable To Update'])); die;
  }

  public function delete($id)
  {
    $request = Request::createFromGlobals();

    $userId = (new AuthController())->login();
    if(!$userId)
    {
      print_r(json_encode(['status'=>'error','data'=>[],'message'=>'Unauthorized User']));
      die;
    }

    if(Customer::where('id',$id)->delete())
    {
      print_r(json_encode(['status'=>'success','message'=>'Successful'])); die;
    }
    else
    {
      print_r(json_encode(['status'=>'error','data'=>[],'message'=>'Unable To Delete'])); die;
    }
  }

 }