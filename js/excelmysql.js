var oFileIn;
//Código JQuery
$(function() {
    oFileIn = document.getElementById('my_file_input');
    if (oFileIn.addEventListener) {
        oFileIn.addEventListener('change', filePicked, false);
    }
});

//Método que hace el proceso de importar excel a html
function filePicked(oEvent) {
    // Obtener el archivo del input
    var oFile = oEvent.target.files[0];
    var sFilename = oFile.name;
    // Crear un Archivo de Lectura HTML5
    var reader = new FileReader();

    // Leyendo los eventos cuando el archivo ha sido seleccionado
    reader.onload = function(e) {
        var data = e.target.result;
        var cfb = XLS.CFB.read(data, {
            type: 'binary'
        });
        var wb = XLS.parse_xlscfb(cfb);
        // Iterando sobre cada sheet
        wb.SheetNames.forEach(function(sheetName) {
            // Obtener la fila actual como CSV
            var sCSV = XLS.utils.make_csv(wb.Sheets[sheetName]);
            var data = XLS.utils.sheet_to_json(wb.Sheets[sheetName], {
                header: 1
            });
            $.each(data, function(indexR, valueR) {
                var sRow = "<tr>";
                $.each(data[indexR], function(indexC, valueC) {
                    sRow = sRow + "<td>" + valueC + "</td>";
                });
                sRow = sRow + "</tr>";
                $("#my_file_output").append(sRow);
            });
        });
        $("#imgImport"). css("display", "none");
    };

// Llamar al JS Para empezar a leer el archivo .. Se podría retrasar esto si se desea
    reader.readAsBinaryString(oFile);
}