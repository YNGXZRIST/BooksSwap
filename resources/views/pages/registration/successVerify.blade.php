@extends('layout.index')
@section('content')
   <div class="successWrapperRegister">
       <img src="{{asset('images/woman_success.svg')}}" style="width: 400px;height: 400px;">
       <div style="display: flex;">
           <div>Успешно! перейти в
           <a class=" orangeLink" href="{{route('profile.index')}}"> профиль</a></div>
       </div>

   </div>


@endsection
<style>
    .successWrapperRegister{
        display: flex;
        flex-direction:column;
        align-items: center;
    }
</style>
