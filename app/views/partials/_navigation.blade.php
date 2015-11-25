<!-- Sample menu definition -->
<ul id="main-menu" class="sm sm-blue">
  <li>    
  </li>
  <li>{{ link_to('/', 'Home') }}</li>
  <li><a href="#">Cadastros</a> 
    <ul>
      <li><a href="#">Funcionários</a>
        <ul>
          <li>{{ link_to('funcionario', 'Funcionários') }}</li>
          <li>{{ link_to('jornada', 'Jornada de Trabalho') }}</li>
          <li>{{ link_to('funcao', 'Funções') }}</li>
        </ul>
      </li>
      <li>{{ link_to('cliente', 'Clientes') }}</li>
      <li>{{ link_to('fornecedor', 'Fornecedores') }}</li>
      <li><a href="#">Equipamentos</a>
        <ul>
          <li>{{ link_to('equipamento', 'Equipamentos') }}</li>
          <li>{{ link_to('categorias_equip', 'Categorias de Equipamentos') }}</li>
          <li>{{ link_to('localizacao', 'Localização de Equipamentos') }}</li>
        </ul>
      </li>
      <li><a href="#">Materiais</a>
        <ul>
          <li>{{ link_to('material', 'Materiais') }}</li>
          <li>{{ link_to('categorias_mat', 'Categorias de Materiais') }}</li>
          <li>{{ link_to('localizacao_mat', 'Localização de Materiais') }}</li>
        </ul>
      </li>
      <li><a href="#">Serviços</a>
        <ul>
          <li>{{ link_to('servico', 'Serviços') }}</li>
          <li>{{ link_to('categorias_servicos', 'Categorias de Serviços') }}</li>
        </ul>
      </li>
      <li>{{ link_to('/', 'Oficinas') }}</li>
      <li><a href="#">Controle de Acessos</a>
        <ul>
          <li>{{ link_to('usuario', 'Usuários') }}</li>
        <li>{{ link_to('perfil', 'Perfil') }}</li>
        </ul>
      </li>
    </ul>
  </li>

  <li><a href="http://www.smartmenus.org/download/">Movimentações</a>
    <ul>
      <li>{{ link_to('/', 'Ordem de Serviços') }}</li>
    </ul>
  </li>

  <li><a href="http://www.smartmenus.org/support/">Consultas</a>
    <ul>
      <li><a href="http://www.smartmenus.org/support/premium-support/">Ordens de serviços</a></li>
    </ul>
  </li>
  <li><a href="#">Minha conta</a>
    <ul class="mega-menu">
      <li>
        <li>{{ link_to('logout', 'Ver Perfil') }}</li>
        <li>{{ link_to('logout', 'Logout ('. Auth::user()->nome . ')') }}</li>
      </li>
    </ul>
  </li>
</ul>