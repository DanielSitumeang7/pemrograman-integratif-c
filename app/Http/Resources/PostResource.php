<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
     // mendefinisikan properti status dan message
     public $status;
     public $message;
 
     /**
      * __construct
      * 
      * @param  mixed  $status
      * @param  mixed  $message
      * @param  mixed  $resource
      * @return void
      */
 
     public function __construct($status, $message, $resource)
     {
         // memanggil parent construct
         parent::__construct($resource);
         // mengisi properti status dan message
         $this->status = $status;
         $this->message = $message;
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
             'data' => $this->resource
         ];
     }
}
