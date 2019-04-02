
let url = [
    "../../connection/login.php",
    "../../connection/cadastrar.php"
];

function send(index) {

    function toJSONString( form ) {
        var obj = {};
        var elements = form.querySelectorAll( "input, select, textarea" );
        for( var i = 0; i < elements.length; ++i ) {
            var element = elements[i];
            var name = element.name;
            var value = element.value;

            if( name ) {
                obj[ name ] = value;
            }
        }

        return JSON.stringify( obj );
    }

    var form = document.getElementById( "form" );
    var output = document.getElementById( "output" );
    var json = toJSONString( form );
    output.innerHTML = json;
    $.ajax({
        type: "POST",
        url: url[index],
        data: json,
        dataType: "json",
        contentType : "application/json",
        success: function(msg){
            alert(msg.result);
        }
    });
}