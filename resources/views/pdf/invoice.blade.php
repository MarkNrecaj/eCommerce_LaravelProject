<h1>Invoice for {{$name}}</h1>

<table border="1px">
    <tr>
        <th>Reciever</th>
        <th>Tel</th>
        <th>Full Address</th>
        <th>Qty</th>
        <th>Order Type</th>
        <th>Can Open</th>
        <th>Can Return</th>
        <th>Additional Notes</th>
        <th>Order Name</th>
        <th>Description</th>
        <th>Total Price</th>
    </tr>
    <tr>
        <td>{{$name}}</td>
        <td>{{$tel}}</td>
        <td>{{$address}}</td>
        <td>{{$quantity}}</td>
        <td>{{$order_type}}</td>
        <td>{{$openable}}</td>
        <td>{{$returnable}}</td>
        <td>{{$additional_notes}}</td>
        <td>{{$order_name}}</td>
        <td>{{$description}}</td>
        <td>{{$price}}</td>
    </tr>
</table>


{{--
    Gjenerimi i QR code nuk po punon, sepse po duhet ne PDF me e gjeneru ne
    formatin png (kodi posht) dhe po kerkon me instalu imagick (procedur e komplikume) 
    
    {!! (QrCode::format('png')->size(100)->generate('Make me into an QrCode!')) !!}

--}}