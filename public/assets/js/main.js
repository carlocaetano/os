$.fn.datepicker.defaults.language = 'pt-BR';
$.fn.datepicker.defaults.format = 'dd/mm/yyyy';
$.fn.datepicker.defaults.autoclose = true;
$.fn.datepicker.defaults.todayHighlight = true;

$.fn.select2.defaults.placeholder = 'Selecione uma opção';

$('form[data-confirm]').submit(function() {
    if(!confirm($(this).attr('data-confirm'))) {
        return false;
    }
});

$('.input-group.date').datepicker();

$('.select2').select2();


$('#main-menu').smartmenus({
	subMenusSubOffsetX: 1,
	subMenusSubOffsetY: -8
});

