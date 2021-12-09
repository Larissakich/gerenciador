<?php 
require 'actions/config.php';
require 'actions/TarefaDaoMysql.php';

$tarefaDao = new TarefaDaoMysql($pdo);
$tarefas = $tarefaDao->findAll();

require 'partials/header.html';
?>

<main>  
    <div class="container">
        <h1 class="text-center" style="font-family: Arial, Helvetica, sans-serif; margin: 20px;">Tarefas</h1>
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#ModalAdd">
            Adicionar Tarefa
        </button>

        <!-- Inicio Listar Tarefa -->
        <table class="table table-lg table-hover">
            <thead>
                <tr>
                <th scope="col">Nome da Tarefa</th>
                <th scope="col">Data de Cadastro</th>
                <th scope="col">Status</th>
                <th scope="col">Prioridade</th>
                <th scope="col">Ações</th>
                </tr>
            </thead>
                <tbody>
                <?php foreach($tarefas as $tarefa):?>
                <tr>
                    <th><?=$tarefa->getTitulo(); ?></th>
                    <td><?=$tarefa->getData(); ?></td>
                    <td><?=$tarefa->getStatus(); ?></td>
                    <td><?=$tarefa->getPrioridade(); ?></td>
                    <td>
                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ModalView<?=$tarefa->getId(); ?>">
                        <i class="bi bi-eye"></i> Vizualizar
                    </button>
                    <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#ModalEdit<?=$tarefa->getId(); ?>">
                        <i class="bi bi-pencil"></i> Editar
                    </button>
                    <a class="btn btn-sm btn-danger" href="actions/excluir_tarefa.php?id=<?=$tarefa->getId();?>" role="button" onclick="return confirm('Tem certeza que deseja excluir?')">
                        <i class="bi bi-trash"></i> Excluir
                    </a>
                    </td>
                </tr>
                <?php endforeach;?>
                </tbody>
        </table>
        <!-- Fim Listar Tarefa -->
    </div>
    

    <!-- Inicio Modal Cadastrar Tarefa--> 
    <div class="modal" id="ModalAdd">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Adicionar Novo Projeto</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="actions/adicionar_tarefa.php">
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input name="titulo" type="text" class="form-control" id="titulo">
                                
                            <label for="descricao">Descrição</label>
                            <textarea name="descricao" class="form-control" id="descricao" rows="3"></textarea>

                            <h5>Status</h5>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="Análise">
                                <label class="form-check-label" for="inlineRadio1">Análise</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="Desenvolvimento">
                                <label class="form-check-label" for="inlineRadio2">Desenvolvimento</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="Revisão">
                                <label class="form-check-label" for="inlineRadio3">Revisão</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio4" value="Concluído">
                                <label class="form-check-label" for="inlineRadio4">Concluído</label>
                            </div>

                            <h5>Prioridade</h5>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="prioridade" id="baixa" value="Baixa">
                                <label class="form-check-label" for="baixa">Baixa</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="prioridade" id="media" value="Média">
                                <label class="form-check-label" for="media">Média</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="prioridade" id="alta" value="Alta">
                                <label class="form-check-label" for="alta">Alta</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="prioridade" id="urgente" value="Urgente">
                                <label class="form-check-label" for="urgente">Urgente</label>
                            </div>

                            <div class="modal-footer">      
                                <input type="submit" class="btn btn-dark" value="Adicionar">
                            </div>
                        </div>      
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fim Modal Cadastrar Tarefa-->

    <!-- Inicio Modal Vizualizar Tarefa-->
    <?php foreach($tarefas as $tarefa):?>
    <div class="modal" id="ModalView<?=$tarefa->getId(); ?>">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="padding: 30px;">

                <div class="modal-header">  
                    <h1><?=$tarefa->getTitulo();?></h1>               
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="d-flex justify-content-between" style="margin-right: 200px;">
                        <p>Status</p>
                        <p><?=$tarefa->getStatus();?></p>
                    </div>           
                    <div class="d-flex justify-content-between" style="margin-right: 200px;">
                        <p>Prioridade</p>
                        <p><?=$tarefa->getPrioridade();?></p>               
                    </div>
                    <div class="d-flex justify-content-between" style="margin-right: 200px;">
                        <p>Data de Cadastro</p>
                        <p><?=$tarefa->getData();?></p>
                    </div>
                        <hr>   
                        <p><?=$tarefa->getDescricao();?></p>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
    <?php endforeach;?>
    <!-- Fim Modal Vizualizar tarefa -->

    <!-- Inicio Modal Editar tarefa -->
    <?php foreach($tarefas as $tarefa):?>
    <div class="modal" id="ModalEdit<?=$tarefa->getId(); ?>">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title">Editar Tarefa</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form method="POST" action="actions/editar_tarefa.php">
                        <input type="hidden" name="id_tarefa" value="<?=$tarefa->getId();?>">
                        <div class="form-group">

                            <label for="titulo">Título</label>
                            <input name="titulo" type="text" class="form-control" id="titulo" value="<?=$tarefa->getTitulo();?>">
                                
                            <label for="descricao">Descrição</label>
                            <input type="text" class="form-control" id="descricao" name="descricao" value="<?= $tarefa->getDescricao(); ?>">

                            <h5>Status</h5>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="Análise" <?= $tarefa->getStatus() == 'Análise' ? 'checked' : ''?>>
                                <label class="form-check-label" for="inlineRadio1">Análise</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="Desenvolvimento" <?= $tarefa->getStatus() == 'Desenvolvimento' ? 'checked' : ''?>>
                                <label class="form-check-label" for="inlineRadio2">Desenvolvimento</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="Revisão" <?= $tarefa->getStatus() == 'Revisão' ? 'checked' : ''?>>
                                <label class="form-check-label" for="inlineRadio3">Revisão</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status" id="inlineRadio4" value="Concluído" <?=$tarefa->getStatus() == 'Concluído' ? 'checked' : ''?>>
                                <label class="form-check-label" for="inlineRadio4">Concluído</label>
                            </div>

                            <h5>Prioridade</h5>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="prioridade" id="baixa" value="Baixa" <?= $tarefa->getPrioridade() == 'Baixa' ? 'checked' : ''?>>
                                <label class="form-check-label" for="baixa">Baixa</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="prioridade" id="media" value="Média" <?= $tarefa->getPrioridade() == 'Média' ? 'checked' : ''?>>
                                <label class="form-check-label" for="media">Média</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="prioridade" id="alta" value="Alta" <?= $tarefa->getPrioridade() == 'Alta' ? 'checked' : ''?>>
                                <label class="form-check-label" for="alta">Alta</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="prioridade" id="urgente" value="Urgente" <?= $tarefa->getPrioridade() == 'Urgente' ? 'checked' : ''?>>
                                <label class="form-check-label" for="urgente">Urgente</label>
                            </div>

                            <div class="modal-footer">      
                                <input type="submit" class="btn btn-warning" value="Editar">
                            </div>
                        </div>      
                    </form>
                </div>

            </div>
        </div>
    </div>
    <?php endforeach;?>
  <!-- Fim Modal Editar -->
</main>

<?php 
require 'partials/footer.html';
?>