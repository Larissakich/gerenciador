<?php 
require 'actions/config.php';
require 'actions/ProjetoDaoMysql.php';

$projetoDao = new ProjetoDaoMysql($pdo);
$projetos = $projetoDao->findAll();

require 'partials/header.html';
?>

<main>
  <h1 class="text-center" style="font-family: Arial, Helvetica, sans-serif; margin: 20px; ">Projetos</h1>
  <div class="container">
    
  <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#ModalAdd">
    Adicionar Projeto
  </button>

  <!-- Inicio Listar Projeto -->
  <table class="table table-md table-hover">
      <thead>
        <tr>
          <th scope="col">Nome do Projeto</th>
          <th scope="col">Data de Cadastro</th>
          <th scope="col">Status</th>
          <th scope="col">Ações</th>
        </tr>
      </thead>
        <tbody>
          <?php foreach($projetos as $projeto):?>
          <tr>
            <th><?=$projeto->getTitulo();?></th>
            <td><?=$projeto->getData(); ?></td>
            <td><?=$projeto->getStatus(); ?></td>
            <td>
              <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#ModalView<?=$projeto->getId();?>">
                <i class="bi bi-eye"></i> Vizualizar
              </button>
              <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#ModalEdit<?=$projeto->getId();?>">
                <i class="bi bi-pencil"></i> Editar
              </button>
              <a class="btn btn-sm btn-danger" href="actions/excluir_projeto.php?id=<?=$projeto->getId(); ?>" role="button" onclick="return confirm('Tem certeza que deseja excluir?')">
                <i class="bi bi-trash"></i> Excluir
              </a>
            </td>
          </tr>
          <?php endforeach;?>
        </tbody>
  </table>
  <!-- Fim Listar Projeto -->
  </div>
  
  
  <!-- Inicio Modal Cadastrar Projeto--> 
  <div class="modal" id="ModalAdd">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Adicionar Novo Projeto</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
            <form method="POST" action="actions/adicionar_projeto.php">
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

                <div class="modal-footer">      
                  <input type="submit" class="btn btn-dark" value="Adicionar">
                </div>
              </div>      
            </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Fim Modal Cadastrar Projeto-->

  <!-- Inicio Modal Vizualizar Projeto-->
  <?php foreach($projetos as $projeto):?>
    <div class="modal" id="ModalView<?=$projeto->getId(); ?>">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" style="padding: 30px;">

          <div class="modal-header">
          
            <h1><?=$projeto->getTitulo();?></h1>
          
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>

          <div class="modal-body">
            <div class="d-flex justify-content-between" style="margin-right: 200px;">
              <p>Status</p>
              <p><?=$projeto->getStatus();?></p>
              
            </div>
            
            <div class="d-flex justify-content-between" style="margin-right: 200px;">
              <p>Data de Cadastro</p>
              <p><?=$projeto->getData();?></p>
              
            </div>
            <hr>   
            <p><?=$projeto->getDescricao();?></p>
          </div>
          
          
          </div>

        </div>
      </div>
    </div>
  <?php endforeach;?>
  <!-- Fim Modal Vizualizar projeto -->

  <!-- Inicio Modal Editar -->
  <?php foreach($projetos as $projeto):?>
  <div class="modal" id="ModalEdit<?=$projeto->getId(); ?>">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title">Editar Projeto</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">
        <form method="POST" action="actions/editar_projeto.php">
          <input type="hidden" name="id" value="<?=$projeto->getId();?>">
              <div class="form-group">

                <label for="titulo">Título</label>
                <input name="titulo" type="text" class="form-control" id="titulo" value="<?=$projeto->getTitulo(); ?>">
                    
                <label for="descricao">Descrição</label>
                <input type="text" class="form-control" id="descricao" name="descricao" value="<?=$projeto->getDescricao(); ?>">

                <h5>Status</h5>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="status" id="inlineRadio1" value="Análise" <?=$projeto->getStatus() == 'Análise' ? 'checked' : ''?>>
                  <label class="form-check-label" for="inlineRadio1">Análise</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="status" id="inlineRadio2" value="Desenvolvimento" <?= $projeto->getStatus() == 'Desenvolvimento' ? 'checked' : ''?>>
                  <label class="form-check-label" for="inlineRadio2">Desenvolvimento</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="status" id="inlineRadio3" value="Revisão" <?= $projeto->getStatus() == 'Revisão' ? 'checked' : ''?>>
                  <label class="form-check-label" for="inlineRadio3">Revisão</label>
                </div>

                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="status" id="inlineRadio4" value="Concluído" <?= $projeto->getStatus() == 'Concluído' ? 'checked' : ''?>>
                  <label class="form-check-label" for="inlineRadio4">Concluído</label>
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
require 'partials/footer.html'
?>