// Prix
$("#range-control").rangeslider({
    polyfill: false,
    onInit: function(position, value){
    	$("#range-control").attr("value", value);
		$(".minpricevalue").text(value);
    },
    onSlide: function(position, value){
        $("#range-control").attr("value", value);
		$(".minpricevalue").text(value + " €");
    }
});
$("#range-control-2").rangeslider({
    polyfill: false,
    onInit: function(position, value){
    	$("#range-control-2").attr("value", value);
		$(".maxpricevalue").text(value);
    },
    onSlide: function(position, value){
        $("#range-control-2").attr("value", value);
		$(".maxpricevalue").text(value + " €");
    }
});
// Catégories
$("#range-cat-1").rangeslider({
    polyfill: false,
    onInit: function(position, value){
    	$("#range-cat-1").attr("value", value);
		$(".catvalue").text(value);
    },
    onSlide: function(position, value){
        $("#range-cat-1").attr("value", value);
		$(".catvalue").text(value);
    }
});
$("#range-cat-2").rangeslider({
    polyfill: false,
    onInit: function(position, value){
    	$("#range-cat-2").attr("value", value);
		$(".subcatvalue").text(value);
    },
    onSlide: function(position, value){
        $("#range-cat-2").attr("value", value);
		$(".subcatvalue").text(value);
    }
});
// Attributs
$("#range-attr-1").rangeslider({
    polyfill: false,
    onInit: function(position, value){
    	$("#range-attr-1").attr("value", value);
		$(".attrvalue").text(value);
    },
    onSlide: function(position, value){
        $("#range-attr-1").attr("value", value);
		$(".attrvalue").text(value);
    }
});
$("#range-attr-2").rangeslider({
    polyfill: false,
    onInit: function(position, value){
    	$("#range-attr-2").attr("value", value);
		$(".subattrvalue").text(value);
    },
    onSlide: function(position, value){
        $("#range-attr-2").attr("value", value);
		$(".subattrvalue").text(value);
    }
});
// Quantité
$("#range-imagecount").rangeslider({
    polyfill: false,
    onInit: function(position, value){
        $("#range-imagecount").attr("value", value);
        $(".imagecountvalue").text(value);
    },
    onSlide: function(position, value){
        $("#range-imagecount").attr("value", value);
        $(".imagecountvalue").text(value);
    }
});
// Quantité
$("#range-qty").rangeslider({
    polyfill: false,
    onInit: function(position, value){
    	$("#range-qty").attr("value", value);
		$(".productqtyvalue").text(value);
    },
    onSlide: function(position, value){
        $("#range-qty").attr("value", value);
		$(".productqtyvalue").text(value);
    }
});