@component('mail::message')

<h1>ACE Net Contact Email</h1>

<strong>Name: </strong> {{$data['name']}}<br/>
<strong>Email: </strong> {{$data['email']}}<br/>
<strong>Phone: </strong> {{$data['mobile']}}<br/>
<strong>Address: </strong> {{$data['address']}}<br/>
<strong>Zone: </strong> {{$data['zone']}}<br/>
<strong>Package: </strong> {{$data['package']}}<br/>
<strong>Message: </strong> {{$data['message']}}

@endcomponent
