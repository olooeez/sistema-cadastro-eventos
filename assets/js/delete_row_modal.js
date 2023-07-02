$(document).ready(function (e) {
  $('#delete_row_modal').on('shown.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('valor');
    var tabela = button.data('tabela');

    $('.modal-body #delete_row_modal_question').text(`Quer deletar o elemento '${id}' da tabela '${tabela}'?`);
    $('.modal-header #delete_row_modal_title').text(`Deletar elemento ${id}`);
    $('.modal-footer #delete_row_modal_accept').attr('href', `http://localhost/sistema-cadastro-eventos/admin/delete/${tabela}/${id}`);
  });
});
