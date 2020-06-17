  $(function() {
		
    $( "#sliderSumLot" ).slider({
      value: 1000000,
      min: 100000,
      max: 3000000,
      step: 10000,
      slide: function( event, ui ) {
        $( "#tbSumLot" ).val(ui.value );
      }
    });
    $( "#tbSumLot" ).val($( "#sliderSumLot" ).slider( "value" ) );
  });

$(document).ready(function() {
	var ms = $('#header');
	ms.mouseenter(function() {
        ms.fadeTo('fast',1);
    });
    ms.mouseleave(function() {
        ms.fadeTo('slow',0.8);    
    });

	//Инициализация начальных значений полей ввода
	//R1 - Выгрузка-СВХ, Услуга по т. Оформлению,  экспертизы на дату выпуска и мощность, справка ЕВРО-5
	//R2 - утилизационный сбор
	var R1 = 10000;
	var R2 = 3150;
	$('#tbSumOther').val(R1 + R2);

	var Date0 = new Date();
	var YYYY0 = Date0.getFullYear() - 5;
	var MM0 = Date0.getMonth() + 2;
	if (parseInt(MM0,10) > 12) {
		MM0 = parseInt(MM0,10) - 12;
		YYYY0++;
		};
	if (parseInt(MM0,10) < 10) {
		MM0 = "0" + MM0;
		};

	$('#tbYYYYMM').val(YYYY0 + "" + MM0);
	
	//Удаляем все что рассчитали прежде
	$('#button2').click( function () {
		$('.result').remove();
	});
	
	$('#button1').click( function () {
		//задаем переменные курсов валют
		var EUR = $('#tbEUR').val();//parseInt($('#tbEUR').val(),10);
		var JPY = $('#tbJPY').val();
		
		//задаем таможенные вилки
		var T1 = new Array("0-3_0","0-3_8501","0-3_16701","0-3_42301","0-3_84501","0-3_169001","3-5_0","3-5_1001","3-5_1501","3-5_1801","3-5_2301","3-5_3001","5+_0","5+_1001","5+_1501","5+_1801","5+_2301","5+_3001");
		var T2 = new Array(2.5,3.5,5.5,7.5,15,20,1.5,1.7,2.5,2.7,3.0,3.6,3.0,3.2,3.5,4.8,5.0,5.7);
		
		//Дата расчета (текущая)
		var Date2 = new Date();
		var MM2 = Date2.getMonth() + 1;
		var DD2 = Date2.getDate();
		var Hours2 = Date2.getHours();
		var Minutes2 = Date2.getMinutes();
		var Seconds2 = Date2.getSeconds();
		if (parseInt(Minutes2,10) < 10) {
		    Minutes2 = "0" + Minutes2;
		    };		
		if (parseInt(Seconds2,10) < 10) {
		    Seconds2 = "0" + Seconds2;
		    };		
		
		if (parseInt(MM2,10) < 10) {
		    MM2 = "0" + MM2;
		    };		
		if (parseInt(DD2,10) < 10) {
		    DD2 = "0" + DD2;
		    };		
		var YYYY2 = Date2.getFullYear();
		
		//Дата продажи авто в Японии
		//var YYYYMM = parseInt($('#tbYYYYMM').val(),10);
		var YYYYMM = $('#tbYYYYMM').val();
		var YYYY = YYYYMM.substring(0,4);
		var MM = YYYYMM.substring(4,6);
		
		var Engine = parseInt($('#tbEngine').val(),10);
		var SumTotal = {
			SumBroker:  parseInt($('#tbSumBroker').val(),10),
			SumOther:  parseInt($('#tbSumOther').val(),10),
			SumLot:  Math.round(parseInt($('#tbSumLot').val(),10) * JPY),
			SumShip:  Math.round(parseInt($('#tbSumShip').val(),10) * JPY),
			SumPoshlina:  0.01,
			getSUM: function() {
				return (SumTotal.SumBroker + SumTotal.SumOther + SumTotal.SumLot + SumTotal.SumShip + SumTotal.SumPoshlina);
				} 
		};
		//возраст машины Age = a1 + a2
		var a1 = YYYY2 - YYYY;
		if ((MM2 - MM)>=0) {
		    var a2 = 1;
		} else {
		    var a2 = 0;  
		}
		var Age = a1 + a2;
		//категория машины AgeCategory = ac1 + ac2
		//ac1
		if (Age <=3) {
		    var ac1 = "0-3";
			var ac3 = "(проходной для 0-3 лет)";
		} else if (Age <=5) {
		    var ac1 = "3-5";
			var ac3 = "(проходной для 3-5 лет)";
		} else {
		    var ac1 = "5+"; 
			var ac3 = "(непроходной для 3-5 лет)"
		}
		//ac2 для категорий 3-5 лет и 5+ лет
		if (ac1!="0-3") {
			if (Engine < 1001) {
				var ac2 = "0";  
			} else if (Engine <1501) {
				var ac2 = "1001";
			} else if (Engine <1801) {
				var ac2 = "1501";
			} else if (Engine <2301) {
				var ac2 = "1801";
			} else if (Engine <3001) {
				var ac2 = "2301";
			} else {
				var ac2 = "3001";
			};
		}
		//ac2 для категории 0-3 лет
		var SumLotEuro = Math.round(SumTotal.SumLot / EUR);
		if (ac1=="0-3") {
			if (SumLotEuro < 8501) {
				var ac2 = "0";  
			} else if (SumLotEuro <16701) {
				var ac2 = "8501";
			} else if (SumLotEuro <42301) {
				var ac2 = "16701";
			} else if (SumLotEuro <84501) {
				var ac2 = "42301";
			} else if (SumLotEuro <169001) {
				var ac2 = "84501";
			} else {
				var ac2 = "169001";
			};
		};
		
		var AgeCategory = ac1 + "_" + ac2;
		
		//таможенный коэффициент
        for (i=0; i < T1.length;i++)
            {
                if (T1[i] == AgeCategory) 
                {var K1 = T2[i]};
            }
		//пересчитываем стоимость таможенной пошлины
		var KE = 0;
		if (ac1!="0-3") {
			SumTotal.SumPoshlina = Math.round(EUR * K1 * Engine);
			var SumPoshlinaText = " (" + K1 + " * " + Engine + " = " + (K1 * Engine) + " Евро)"
		} else {
			if (AgeCategory=="0-3_0") {
				KE = 0.54;
			} else {
				KE = 0.48;
			};
			SumTotal.SumPoshlina = Math.round(EUR * K1 * Engine);
			if ((SumLotEuro * KE)> Math.round(K1 * Engine)) {
				SumTotal.SumPoshlina = Math.round(SumLotEuro * KE * EUR);
				SumPoshlinaText = " (" + (KE * 100) + "% от стоимости лота)";
			} else {
				SumPoshlinaText = " (" + K1 + " * " + Engine + " = " + (K1 * Engine) + " Евро)";
			};
		};
		//транспортный налог
		
		//Удаляем все что рассчитали прежде
		//$('.result').remove();
		
		//Вывод на экран
		$('#outputs').append("<p class='result'><b>Расчет произведен на: " + DD2 + "." + MM2 + "." + YYYY2  + " " + Hours2 + ":" + Minutes2 + ":" + Seconds2 + "</b> по курсам валют EUR:" + EUR + ", JPY:" + JPY + 
		"<br>Стоимость лота, JPY: " + $('#tbSumLot').val() +  
		"<br>Объем двигателя, куб. см: " + $('#tbEngine').val() +
		"<br>Возраст авто: " + Age + ac3 + ", категория: [" + AgeCategory + "]" +
		"<br><br>Комиссия брокера, руб: " + SumTotal.SumBroker + 
		"<br>Доставка из Японии, руб: " + SumTotal.SumShip + 
		"<br>Прочие расходы, руб: " + SumTotal.SumOther + 
		"<br>Стоимость лота, руб: " + SumTotal.SumLot + " (" + SumLotEuro + " евро)" +
		"<br>Таможенная пошлина, руб: " + SumTotal.SumPoshlina + SumPoshlinaText +
		"<br><b>ВСЕГО ЗАТРАТ, руб: " + SumTotal.getSUM() + "</b>");
		$('#outputs').append("<br class='result'>");
		$('#outputs').append("<br class='result'>");
	});
	
});




