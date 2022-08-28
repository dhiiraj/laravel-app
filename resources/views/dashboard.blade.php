<x-app-layout>
    <div class="container">
        <div class="py-12 card ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form id="contactForm">
                    <div class="form-group">
                        <input type="text" name="inputsymbol" class="form-control" placeholder="Enter symbol" id="inputsymbol" required>
                    </div>
                    <div class="form-group right">
                        <button class="btn btn-success" id="submit">Submit</button>
                    </div>
                </form>
            </div>
            <table  class="table">
                <thead class="thead-dark border">
                    <tr>
                        <th> Symbol </th>
                        <th> Open </th>
                        <th> High </th>
                        <th> Low </th>
                        <th> Price</th>
                        <th> Previous Close </th>
                        <th> Change </th>
                        <th> Change Percentage </th>
                        <th> Volume </th>
                        <th> Last Trading Daya </th>
                    </tr>
                </thead>
                <tbody class="thead-light">
                    <tr>
                        <td id='symbol'>  </td>
                        <td id='open'>  </td>
                        <td id='high'> </td>
                        <td id='low'>  </td>
                        <td id='price'>  </td>
                        <td id='previous_close'>  </td>
                        <td id='change'> </td>
                        <td id='change_percent'> </td>
                        <td id='volume'>  </td>
                        <td id='latest_trading_day'> </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
 $('#contactForm').on('submit',function(e){
        e.preventDefault();
    var symbol = $("#inputsymbol").val();
    $.ajax({
        type:'GET',
        url:'/api/getData?query='+symbol,
        data:'_token = <?php echo csrf_token() ?>',
        success:function(response) {
            if(response.status){
                $("#symbol").text(response.data.symbol);
                $("#open").text(response.data.open);
                $("#high").text(response.data.high);
                $("#low").text(response.data.low);
                $("#price").text(response.data.price);
                $("#previous_close").text(response.data.previous_close);
                $("#change").text(response.data.change);
                $("#change_percent").text(response.data.change_percent);
                $("#volume").text(response.data.volume);
                $("#latest_trading_day").text(response.data.latest_trading_day);
            }else{
                alert(response.message);
            }
        }
    });
    });
</script>