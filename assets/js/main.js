'use strict';

var Produto = {};

Produto.functions = {
    edit: (id,input_data) => {
        console.log("edit "+id);
        const url = './?action=update&id='+id;
        $.post(url, input_data, (data) => {
            if (data.err == undefined || data.err == false) {
                return true;
            } else {
                return false;
            }
        });
    },
    add: (input_data) => {
        console.log("add");
        const url = './?action=add';
        $.post(url, input_data, (data) => {
            if (data.id != undefined) {
                alert("Produto cadastrado com sucesso!");
                location.href = './?action=get&id='+data.id;
            } else {
                alert('Erro ao tentar cadastrar o novo produto');
            }
        });
    },
    delete: (id, btn) => {
        console.log("delete "+id);
        const url = './?action=delete&id='+id;
        $.post(url, (data) => {
            if (data.err == undefined || data.err == false) {
                //apagar linha da tabela
                if (btn.hasClass('btn-tabela-apagar')) {
                    btn.closest('tr').remove();
                } else {
                    location.reload();
                }
            } else {
                alert('Erro ao tentar apagar o produto');
            }
        });
    }
};

$(document).ready(function(){
    $('.editar').on('click',function(){
        let id = $(this).data('id');
        location.href = './?action=get&id='+id;
    });
    
    $('.novo').on('click',function(){
        location.href = './?action=create';
    });
    
    $('.link-detalhes').on('click', function () {
        const id = $(this).data("id");
        const url = './?action=getJSON&id='+id;
        $.get(url, (data) => {
            $('#detailModalLongTitle').html(data.nome);
            let modal_body = '<p><b>Descrição:</b> ' + data.descricao + '</p>';
            modal_body    += '<p><b>Quantidade:</b> ' + data.quantidade + '</p>';
            modal_body    += '<p><b>Preço:</b> ' + data.valor + '</p>';
            modal_body    += '<p><b>Data de criação:</b> ' + data.created_at + '</p>';
            $('.modal-body').html(modal_body);
            $('#detailModal').modal();
        });
    });
    
    $("#quantidade").priceFormat({
        prefix: '',
        centsSeparator: ',',
        thousandsSeparator: '.',
        centsLimit: '0'
    });
    
    $("#valor").priceFormat({
        prefix: '',
        centsSeparator: ',',
        thousandsSeparator: '.'
    });
    
    $('#form_produto').on('submit',function(e){
        e.preventDefault();
        
        let valor = $('#valor').val();
        valor = valor.replace('.','');
        valor = valor.replace(',','.');
        const input_data = {
            'nome': $('#nome').val(),
            'descricao': $('#descricao').val(),
            'quantidade': $('#quantidade').val(),
            'valor': valor
        };
        if ($('#id').val() != undefined && $.isNumeric($('#id').val())) {
            let id = $('#id').val();
            Produto.functions.edit(id,input_data);
        } else {
            Produto.functions.add(input_data);
        }

    });

    $('.btn-tabela-apagar').on("click",function(){
        const id = $(this).data("id");
        const btn = $(this);
        if (confirm('Tem certeza que deseja apagar o registro?\nEssa operação não tem volta!')) {
            Produto.functions.delete(id, btn);
        }
    });
    
    $('.reduzir-estoque, .aumentar-estoque').on("click",function(){
        const id = $(this).data("id");
        const url = './?action=getJSON&id='+id;
        const btn = $(this);
        $.get(url, (data) => {
            if (data.quantidade !== 'undefined') {
                let quantidade = parseInt(data.quantidade);
                if ($(this).hasClass('reduzir-estoque')) {
                    quantidade--;
                } else {
                    quantidade++;
                }
                quantidade = (quantidade < 0) ? 0 : quantidade;
                let input_data = {'quantidade' : quantidade};
                Produto.functions.edit(id,input_data);
                btn.closest('tr').find('td:eq(2)').html(quantidade);
            }
        });
    });
});


