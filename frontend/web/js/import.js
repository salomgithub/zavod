$('#import-form').on('beforeSubmit', function (e) {
    e.preventDefault();
    var form = $(this);
    $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: new FormData(form[0]),
        processData: false,
        contentType: false,
        success: function (data) {
            var parsedData = JSON.parse(data);
            // Fayl muvaffaqiyatli yuklandi, uning ichidagi ma'lumotlarni o'qish
            if (Array.isArray(parsedData) && parsedData.length > 0) {
                var allValues = [];
                for (var i = 0; i < parsedData.length; i++) {
                    var currentRow = parsedData[i];
                    console.log('Array[' + i + ']: ' + JSON.stringify(currentRow));
                    
                    // O'zingizning indexni aniqlang
                    var operValue = currentRow[2];
                    console.log('Oper Value: ' + operValue);
                    
                    // Barcha qiymatlarni to'plang
                    allValues.push(operValue);
                }
                
                console.log('All Values: ' + JSON.stringify(allValues));
            } else {
                console.log('Faylda ma\'lumot topilmadi yoki xatolik ro\'y berdi.');
            }
        },
        error: function (data) {
            console.log('Faylda ma\'lumot topilmadi yoki xatolik ro\'y berdi.');
        }
    });
});
