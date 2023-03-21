<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
     // mendefinisikan properti status dan message
     public $status;
     public $message;
     public $statuscode;
 
     /**
      * __construct
      * 
      * @param  mixed  $status
      * @param  mixed  $message
      * @param  mixed  $resource
      * @return void
      */
 
     public function __construct($status, $message,  $resource, $statuscode)
     {
         // memanggil parent construct
         parent::__construct($resource);
         // mengisi properti status dan message
         $this->status = $status;
         $this->message = $message;
         $this->statuscode = $statuscode;
     }
 
     /**
      * Transform the resource into an array.
      * 
      * @param  \Illuminate\Http\Request  $request
      * @return array
      */
     
     public function toArray($request)
     {
         return [
             'status' => $this->status,
             'message' => $this->message,
             'statuscode' => $this->statuscode,
             'data' => $this->resource,
         ];
     }
}
