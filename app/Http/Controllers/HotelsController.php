<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\Amenities;
use App\Amenthot;

class HotelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $hotel = Hotel::all();
      $amenities = Amenities::all();
      $ame_hot = Amenthot::all();

      for($i = 0; $i < count($ame_hot); $i++){
        for($j = 0; $j < count($amenities); $j++){
          if($ame_hot[$i]->ameniti == $amenities[$j]->id){
            $ame_hot[$i]->ameniti = $amenities[$j]->name;
            $j = count($amenities) + 1;
          }
        }
      }

      for($i = 0; $i < count($hotel); $i++){
        $hotel[$i]->amenities = array();
        for($j = 0; $j < count($ame_hot); $j++){
          if($hotel[$i]->id == $ame_hot[$j]->hotel){
            $newArr = array();
            $newArr = $hotel[$i]->amenities;
            array_push($newArr, $ame_hot[$j]->ameniti);
            $hotel[$i]->amenities = $newArr;
          }
        }
      }

      return $hotel;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getByAmenties(Request $request)
    {
      $amenitiesSpec = Amenities::where('name', $request->amenity)->get();
      $ame_hots = Amenthot::where('ameniti', $amenitiesSpec[0]->id)->get();
      $amenities = Amenities::all();

      $hotels = array();

      for($index = 0; $index < count($ame_hots); $index++){
        $hotel = Hotel::where('id', $ame_hots[$index]->hotel)->get();

        $ame_hot = Amenthot::where('hotel', $hotel[0]->id)->get();

        for($j = 0; $j < count($ame_hot); $j++){
          for($k = 0; $k < count($amenities); $k++){
            if($ame_hot[$j]->ameniti == $amenities[$k]->id){
              $ame_hot[$j]->ameniti = $amenities[$k]->name;
              $k = count($amenities) + 1;
            }
          }
        }

        $hotel[0]->amenities = array();
        for($j = 0; $j < count($ame_hot); $j++){
          if($hotel[0]->id == $ame_hot[$j]->hotel){
            $newArr = array();
            $newArr = $hotel[0]->amenities;
            array_push($newArr, $ame_hot[$j]->ameniti);
            $hotel[0]->amenities = $newArr;
          }
        }

        array_push($hotels, $hotel[0]);
      }

      return $hotels;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getByPrice(Request $request)
    {
      $min = $request->min;
      $max = $request->max;

      $hotel = Hotel::whereBetween('price', [$min, $max])->get();

      $amenities = Amenities::all();

      for($i = 0; $i < count($hotel); $i++){
        $ame_hot = Amenthot::where('hotel', $hotel[$i]->id)->get();

        for($j = 0; $j < count($ame_hot); $j++){
          for($k = 0; $k < count($amenities); $k++){
            if($ame_hot[$j]->ameniti == $amenities[$k]->id){
              $ame_hot[$j]->ameniti = $amenities[$k]->name;
              $k = count($amenities) + 1;
            }
          }
        }

        $hotel[$i]->amenities = array();
        for($j = 0; $j < count($ame_hot); $j++){
          if($hotel[$i]->id == $ame_hot[$j]->hotel){
            $newArr = array();
            $newArr = $hotel[$i]->amenities;
            array_push($newArr, $ame_hot[$j]->ameniti);
            $hotel[$i]->amenities = $newArr;
          }
        }
      }

      return $hotel;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getByStars(Request $request)
    {
        $min = $request->min;
        $max = $request->max;

        $hotel = Hotel::whereBetween('stars', [$min, $max])->get();

        $amenities = Amenities::all();

        for($i = 0; $i < count($hotel); $i++){
          $ame_hot = Amenthot::where('hotel', $hotel[$i]->id)->get();

          for($j = 0; $j < count($ame_hot); $j++){
            for($k = 0; $k < count($amenities); $k++){
              if($ame_hot[$j]->ameniti == $amenities[$k]->id){
                $ame_hot[$j]->ameniti = $amenities[$k]->name;
                $k = count($amenities) + 1;
              }
            }
          }

          $hotel[$i]->amenities = array();
          for($j = 0; $j < count($ame_hot); $j++){
            if($hotel[$i]->id == $ame_hot[$j]->hotel){
              $newArr = array();
              $newArr = $hotel[$i]->amenities;
              array_push($newArr, $ame_hot[$j]->ameniti);
              $hotel[$i]->amenities = $newArr;
            }
          }
        }

        return $hotel;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getByName(Request $request)
    {
      $name = $request->name;

      $hotel = Hotel::where('name', $name)
                     ->orderBy('name', 'desc')
                     ->get();

     $amenities = Amenities::all();

     for($i = 0; $i < count($hotel); $i++){
       $ame_hot = Amenthot::where('hotel', $hotel[$i]->id)->get();

       for($j = 0; $j < count($ame_hot); $j++){
         for($k = 0; $k < count($amenities); $k++){
           if($ame_hot[$j]->ameniti == $amenities[$k]->id){
             $ame_hot[$j]->ameniti = $amenities[$k]->name;
             $k = count($amenities) + 1;
           }
         }
       }

       $hotel[$i]->amenities = array();
       for($j = 0; $j < count($ame_hot); $j++){
         if($hotel[$i]->id == $ame_hot[$j]->hotel){
           $newArr = array();
           $newArr = $hotel[$i]->amenities;
           array_push($newArr, $ame_hot[$j]->ameniti);
           $hotel[$i]->amenities = $newArr;
         }
       }
     }

      return  $hotel;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
