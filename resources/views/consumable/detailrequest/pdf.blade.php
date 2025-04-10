<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="PatimOne Consul Requisition Form">
    <meta name="author" content="PatimOne Consul">
    <meta name="keywords" content="PatimOne, Consul, Requisition, Form">
    <meta name="robots" content="index, follow">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        @page {

        margin: 0px;
        padding: 0px;
        padding-left: 10px;
        size: A4;
        }
        * {
            box-sizing: border-box;
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;

            color: #333;
        }
        
        body {
            line-height: 1.6;
            font-size: 12px;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding-left: 20px;
            padding-right: 10px;
            padding-top: 8px;
            padding-bottom: 10px;
        }
        section.header {
            line-height:0.6; 
            background-color: #f8f8f8;
        }
        section.header h2 {
            font-size: 24px;
            margin: 0;
            padding: 10px 0;
        }
        section.header2 {
            text-align: left;
        }
        section.header2 h2 {
            font-size: 15px; /* Corrected font size */
            text-align: left;
            margin: 0;
            padding: 10px 0;        
        }
        section.header2 p {
            font-size: 10px;
            margin: 0;
            text-align: justify ;
            line-height: 1.4;
        }
        section.header p {
            font-size: 8px;
            margin: 0;
            padding: 5px 0;
        }
        section.header .title1 {
            width: 50%;
            float: left;
        }
        section.header .title2 {
            padding-top: 20px;
            padding-right: 20px;
            width: 50%;
            float: right;
            text-align: left;
        }
        section .header .title2 {
            font-size: 10px; /* Added font size for better visibility */
        }
        h2, h3 {
            color: #333;
        }
        p {
            color: #555;
        }
        /* Style for table headers */
        th {
            background-color: #f2f2f2;
            text-align: center;
            line-height: 1.2;
            font-weight: bold;
            font-size: 10px; /* Adjusted font size for table headers */
            padding: 15px;

        }
        /* Style for table rows */
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border: 1px solid #000; /* Ensure all table borders are black */
        }
        th, td {
            border: 1px solid #000; /* Ensure all cell borders are black */
            padding: 2px;
            text-align: left;
        }
        thead {
            display: table-header-group; /* Ensure the header is only displayed on the first page */
        }
        tfoot {
            display: table-row-group;
        }
        tbody {
            display: table-row-group;
        }
    </style>

    <title>Form Requisition PatimOne Consul</title>
</head>
<body>
    <section class="header">
        <div class="title1">
            <h2>Patim<b style="color: red">O</b>ne Consul</h2>
            <p>Patimban Port Development Project</p>
            <p>Contract Package 6: Container Terminal No. 2 Construction</p>            
        </div>
        {{-- put request date and request number to the right side of the header --}}
        
        <div class="title2">
            <p>Request date: <u style="padding-left: 50px; text-align: right">{{date('Y-m-d')}}</u></p>
            <p>Request No: <u style="padding-left: 50px; text-align: right">{{$requisition->requisition_no}}</u></p>
        </div>

        <br>
    </section>
    <section class="header2">
        <h2>REQUISITION / SUPPLY of EXPANDABLE  ITEMS for Engineer's SITE OFFICE</h2>        
        <p><b>To. The Contractor (PTRPWJ)</b></p>
        <p>We are hereby requested to supply the following expendable items persuant to the requirements of Technical Specification, sub Chapter 2.1 and Bill of Quantity item no. 132:</p>
    </section>
    <table>
        <thead> 
            <tr>
                <th style="width: 5%; text-align: center">No.</th>
                <th style="width: 30%">Description of Item </th>
                <th style="text-align: center">Preferred Brand </th>
                <th style="text-align: center">Unit</th>
                <th style="text-align: center">Qty</th>
                <th style="text-align: center">Date Requested By The Engineer</th>
                <th style="text-align: center">Date Supplied By The Engineer</th>
                <th style="text-align: center">Received By The Engineer</th>
            </tr>
        </thead>
        <tbody>
            @php
                $groupedDetails = $requisition->details->groupBy('category');
            @endphp
            @foreach ($groupedDetails as $category => $details)
                <tr>
                    <td colspan="8" style="text-align: left; font-weight: bold; background-color: #ddd;">
                        {{ $category }}
                    </td>
                </tr>
                @foreach ($details as $key => $item)
                    <tr style="text-align: left;">
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->description_item }}</td>
                        <td>{{ $item->preferred_brand }}
                            @if($item->photo)
                            @foreach (json_decode($item->photo) as $photo)                            
                            <br>
                            
                            <img src="{{ public_path('requisition_attachments/' . $photo) }}" alt="Image" style="width: 60px; margin-right: 10px;">

                            @endforeach 
                            @endif

                        </td>
                        <td>{{ $item->unit }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->request_date)->format('d/m/Y') }}</td>
                        <td>{{ $item->supplied_date }}</td>
                        <td>{{ $item->received_date }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8" style="text-align: left; line-height: 0.6;  font-size: 10px; padding-top: 3px;">
                    <p>Note: For Consumable items  requiring longer time to purchase, please allow at least "5 working days" from date request to date required</p>
                    
                </td>
            </tr>
            <tr style=" height: 100px;">
                <td colspan="4" style="text-align: left; font-size: 10px; padding-top: 3px; vertical-align: top;">
                    <p>Requested by: The Engineer (PatimOne Consul)</p>
                    <div>
                        <p><b>Prepared By:</b></p>
                    <br>
                    <br>
                    <p><u><b>YULIHARDI</b></u></p>
                   </div>
                   <div>
                        <p><b>Approved By:</b></p>
                    <br>
                    <br>
                    <p><u><b>LE PHUONG DONG</b></u></p>
                   </div>
                    
                </td>
                <td colspan="4" style="text-align: left; font-size: 10px; padding-top: 3px; vertical-align: top;">
                    <p>Contractor's acknowledgement Receipt</p>
                 
                </td>
            </tr>
            <tr style=" height: 100px;">
                <td colspan="4" style="text-align: left; font-size: 10px; padding-top: 3px; vertical-align: top;">
                    <p>to be signed by the Contractor's PM after delivered of all requested items</p>
                    <p>Supplied By: The Contractor (PTRPWJ)</p>
                    
                    
                </td>
                <td colspan="4" style="text-align: center; font-size: 10px; padding-top: 3px; vertical-align: top;">
                    <p>Engineer's acknowledgement Receipt:</p>
                    
                    
                    <p><u>YULIHARDI</u></p>
                    <p>Office Manager</p>
                </td>
            </tr>
        </tfoot>
    </table>
</body>
</html>