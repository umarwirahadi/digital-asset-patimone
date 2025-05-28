<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Label</title>
</head>
<style>
      @page {
        margin: 0px;
        padding: 0px;
        padding-left: 10px;
        size: A4;       
        margin: 0;
    }

    * {
        box-sizing: border-box;
    }

    html,
    body {
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

    .container {
        display: grid;
        gap: 5px 5px;
        grid-template-columns: auto auto auto;
    }

    .container>div {
        background-color: #f1f1f1;
        width: 300px;
        /* border: 1px solid black; */
        /* padding: 20px; */
        font-size: 30px;
        text-align: center;
    }

    .main-table {
        width: 100%;
        border-collapse: collapse;
        background-color: {{$options['background_color']}};
         
    }

    .main-table tr td {
        border: 1px double black;
        padding: 2px 5px;
        font-size: 10px;
        line-height: 1.2;
    }

    .table-content tr td {
        border: none;
        /* padding: 2px 5px; */
        font-size: 10px;
        line-height: 0.9;
    }

    .content-title {
        font-size: 10px;
        font-weight: bold;
        padding: 5px;
        /* margin: 2px; */
        border: 1px solid black;
        text-align: center;
    }
</style>

<body>
    @php
    $quantity = $product->quantity ?? 1;
    $products = collect();
    for ($i = 0; $i < $quantity; $i++) { $products->push($product);
        }
        $totalQuantity = $products->count(); // Calculate total quantity
        $totalPages = ceil($totalQuantity / 5); // Calculate total pages, 2 products per page
        $currentPage = 1; // Initialize current page
        $productsPerPage = 5; // Define number of products per page
        @endphp


        <section class="container">
            @foreach ($products as $numb=>$prod)
                @if ($numb % $productsPerPage == 0)
                    <div style="width: 100%; text-align: right; margin-top: 10px;">
                        Page {{ $currentPage }} of {{ $totalPages }}
                    </div>
                    @php
                    $currentPage++;
                    @endphp
                @endif

            <div style="display: flex; width: 50%; margin-bottom: 10px;">
                <table class="main-table">
                    <tr class="content-title">
                        <td colspan="2">
                            Asset {{$product->package->package_name}}
                            <br>Patimban Port Project Development
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top; text-align: center;width: 30px; height: 50px;">
                            <img src="{{ public_path('statics/img/kemenhub.png') }}" alt="Logo" style="width: 40px; height: auto;">
                        </td>
                        <td>
                            <table class="table-content">
                                <tr>
                                    <td>Code</td>
                                    <td>:</td>
                                    <td>{{$prod->code}}</td>
                                </tr>
                                <tr>
                                    <td>Index</td>
                                    <td>:</td>
                                    <td>{{$prod->code_index ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td style="text-align: justify">Name</td>
                                    <td>:</td>
                                    <td>{{$prod->name}}</td>
                                </tr>
                                <tr>
                                    <td>Number</td>
                                    <td>:</td>
                                    <td>{{$numb+1}} Total. {{$prod->quantity ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Date</td>
                                    <td>:</td>
                                    <td>{{\Carbon\Carbon::parse($prod->delivery_date)->format('d-M-Y') ?? ''}}</td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td>:</td>
                                    <td>{{$prod->location ?? ''}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </div>

            @endforeach
        </section>

</body>

</html>