@component('mail::message')

<style>
.btn {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
</style>

One Time Password: {{$TOTP}}

<form target="_blank" @if(auth()->guard('administration')->check()) action="{{route('admin.TOTP.check')}}" @else action="{{route('client.TOTP.check')}}" @endif method="POST">
    @csrf
    <input name="totp" type="hidden" value="{{$TOTP}}">
    <button type="submit" class="btn">Verify</button>
</form>

<div style="margin-top:10px">Thanks</div>
@endcomponent
