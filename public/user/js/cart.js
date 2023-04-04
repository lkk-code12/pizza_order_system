$(document).ready(function() {
    //when click + button
    $('.btn-plus').click(function() {
        $parentNode = $(this).parents('tr');

        $price = $parentNode.find('#price').val();
        // console.log($price);

        $qty = Number($parentNode.find('#pizzaQty').val());
        // console.log($qty);

        $total = $price * $qty;
        $parentNode.find('#total').html($total + ` MMK`);

        summaryCalculation();
    })

    //when click - button
    $('.btn-minus').click(function() {
        $parentNode = $(this).parents('tr');

        $price = $parentNode.find('#price').val();
        // console.log($price);

        $qty = Number($parentNode.find('#pizzaQty').val());
        // console.log($qty);

        if ($qty == 0) {
            $('.btn-minus').attr('disabled');
        }

        $total = $price * $qty;
        $parentNode.find('#total').html($total + ` MMK`);

        summaryCalculation();
    })


    //calculate final price
    function summaryCalculation() {
        $totalPrice = 0;
        $('#dataTable tr').each(function(index, row) {
                $price = parseInt($(row).find('#total').text());
                // console.log($price);
                // $('#subTotal').text($price += $total);
                $totalPrice += $price;
            })
            // console.log($totalPrice);

        $('#subTotalPrice').html($totalPrice + ` MMK`);

        $('#totalCost').html($totalPrice + 3000 + ` MMK`);
    }
})