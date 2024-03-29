<?php
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.min.js"></script>
    <title>Document</title>
</head>

<body>
    <div class="container">
        <form>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="inputNome">Nome Completo</label>
                    <input type="text" class="form-control" id="email" placeholder="Nome Completo" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Confirme o Email</label>
                    <input type="email" class="form-control" id="confirmeEmail" placeholder="Confirme o Email" required>
                    <div class="alert alert-danger" style="display: none;" id="erroEmail" role="alert"></div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Senha <small>mínimo 6 caractres</small></label>
                    <input type="password" minlength="6" class="form-control" id="senha" placeholder="Senha" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputPassword4">Confirme Senha</label>
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Confirme a Senha" required>
                    <div class="alert alert-danger" style="display: none;" id="erroSenha" role="alert"></div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="cpf">CPF</label>
                    <input type="text" class="form-control" id="cpf" placeholder="CPF" placeholder="CPF" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="rg">RG</label>
                    <input type="text" class="form-control" id="rg" placeholder="RG" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="rg">Data Nacimento</label>
                    <input type="text" class="form-control" id="dataNascimento" placeholder="RG" required>
                </div>
            </div>

            <div class="form-row">                
                <div class="form-group col-md-3">
                    <label for="ddi">DDI</label>
                    <input type="text" class="form-control" id="ddi" placeholder="DDI" value="+51" disabled required>
                </div>
                <div class="form-group col-md-3">
                    <label for="ddd">DDD</label>
                    <?php include('includes/ddd.php') ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Celular</label>
                    <input type="text" class="form-control" id="ddi" placeholder="DDI" required>
                </div>
            </div>

            <div class="form-row">                
                <div class="form-group col-md-3">
                    <label for="ddi">DDI</label>
                    <input type="text" class="form-control" id="ddi" placeholder="DDI" value="+51" disabled required>
                </div>
                <div class="form-group col-md-3">
                    <label for="ddd">DDD</label>
                    <?php include('includes/ddd.php') ?>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Telefone</label>
                    <input type="text" class="form-control" id="ddi" placeholder="DDI" required>
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="inputAddress">CEP</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="Endereço" required>
                </div>
                <div class="form-group col-md-9">
                    <label for="inputAddress2">Endereço</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Endereço" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="inputAddress">Número</label>
                    <input type="text" class="form-control" id="inputAddress" placeholder="Número" required>
                </div>
                <div class="form-group col-md-9">
                    <label for="inputAddress2">Complemento</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Complemento" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="inputCity">Cidade</label>
                    <input type="text" class="form-control" id="cidade">
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Estado</label>
                    <?php include('includes/estado.php') ?>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="codBanco">Código do seu Banco</label>
                    <?php include('includes/banco.php') ?>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="codBanco">Tipo de Conta</label>
                    <select name="" id="" class="form-control">
                        <option>Tipo de conta</option>
                        <option value="conta_corrente">Conta Corrente</option>
                        <option value="conta_poupanca">Conta Poupança</option>
                        <option value="conta_corrente_conjunta">Conta Corrente Conjunta</option>
                        <option value="conta_poupanca_conjunta">Conta Poupança Conjunta</option>
                    </select>
                </div>



                <div class="form-group col-md-3">
                    <label for="agencia">Agência</label>
                    <input class="form-control" type="text" id="agencia" required />
                </div>



                <div class="form-group col-md-3">
                    <label for="agencia">DV Agência</label>
                    <input class="form-control" type="text" id="dvAgencia" required />
                </div>
            </div>

            <div class="form-row">

            </div>

            <div class="form-row">
                <div class="form-group col-md-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="aceito">
                        <label class="form-check-label" for="gridCheck">
                            Li e concordo com os termos de uso. <a href="">Leia aqui.</a>
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Assinar</button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>