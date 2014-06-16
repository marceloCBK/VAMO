<?php

class ProdutosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $produtos = Produtos::orderBy('id_pro', 'DESC')->paginate(20);
		return View::make('ListProdutos')
            ->with(Config::get('Globals'))
            ->with(
                array(
                    'produtos' => $produtos
                )
            )
            ;
    }

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $produtosTipo = ProdutosTipo::where('status_ptp', 1)->get();
        return View::make('SetProdutos')
            ->with(Config::get('Globals'))
            ->with(
                array(
                    'produtosTipo' => $produtosTipo
                )
            )
            ;
            ;
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $rules = array(
        //'username' => array('required', 'unique:users,username'),
        //'email'    => array('required', 'email', 'unique:users,email'),
        'nome_pro' => array('required', 'min:3'),
        'descricao_pro' => array('required', 'min:10'),
        'id_ptp_pro' => array('required')
    );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails())
        {
            // Validation has failed.
            //return Redirect::back();//->with_input()->with_errors($validation);
            //$mensagem[] = $validation;
        } else {
            $form = Input::all();
            $produtos = new Produtos();
            $produtos->id_ptp_pro = $form['id_ptp_pro'];
            $produtos->nome_pro = $form['nome_pro'];
            $produtos->status_pro = $form['status_pro'];
            $produtos->descricao_pro = $form['descricao_pro'];
            $produtos->first_date_pro = date("Y-m-d");
            $resp = $produtos->save();

            if ($resp) {
                //Upload->
                $id = $produtos->id_pro;//seleciona id da submissão referente
                $titulo = ConteudoController::CharSP($produtos->nome_pro); //Usa o titulo do trabalho como nome de arquivo
                $fileName = 'nome_arq';
                if(Input::hasFile($fileName)){
                    $arquivos   = Arquivos::where('id_fk_arq', $id)->first();
                    //$titulo    .= (($arquivos->count())?$arquivos->count():'');

                    if ($arquivos->id_arq) {//remove o arquivo anterior
                        $file = $_SERVER['DOCUMENT_ROOT'].$arquivos->caminho_arq.'/'.$arquivos->nome_arq;
                        if (file_exists($file)) {
                            unlink($file);
                        }
                    }

                    $idArea     = 'produtos';
                    //retorna "Upload não realizado! Arquivo não encontrado!" se o usuario não enviar o arquivo
                    $respUp = ConteudoController::Uploader($fileName, $id, $titulo, $idArea);
                    $error['respUp'] = $respUp['error'];

                    if ($respUp['resp']) {
                        if (!($arquivos->id_arq)) {
                            $arquivos = new Arquivos();
                        }
                        $arquivos->nome_arq = $respUp['nome'];
                        $arquivos->id_fk_arq = $id;
                        //$arquivos->id_ars_arq = $idArea;
                        $arquivos->caminho_arq = $respUp['caminho'];
                        $respArquivos = $arquivos->save();
                    }
                }
                //Upload<-
            }
        }

        $acao = 'inserido';
        if ($resp)          {$menssagem[] = '<b>'.$produtos->nome_pro.'</b> '.$acao.' com sucesso!';}
        else                {$menssagem[] = 'Ops! Um <b>problema</b> aconteceu. <b>Tente novamente</b> mais tarde.';}
        if ($respArquivos)  {$menssagem[] = 'Arquivo <b>'.$arquivos->nome_arq.'</b> foi adicionado com sucesso!';}

        $resp = json_encode(array(
            'resp'      => $resp,
            'mensagem'  => $menssagem,
            'id'        => $id,
        ));
        //return var_dump($resp);
        return Redirect::to('produtos')
            ->with(array('resp' => $resp))
            ;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        if(!($id>0)) return App::abort(404);

        $produtos       = Produtos::find($id);
        $produtosTipo   = ProdutosTipo::where('status_ptp', 1)->get();

        if(!($produtos->id_pro)) return App::abort(404);

        return View::make('SetProdutos')
            ->with(Config::get('Globals'))
            ->with(
                array(
                    'produtos' => $produtos,
                    'produtosTipo' => $produtosTipo,
                )
            )
            ;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        if(!($id>0)) return App::abort(404);

        $rules = array(
            //'username' => array('required', 'unique:users,username'),
            //'email'    => array('required', 'email', 'unique:users,email'),
            'nome_pro' => array('required', 'min:3'),
            'descricao_pro' => array('required', 'min:10'),
            'id_ptp_pro' => array('required')
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails())
        {
            // Validation has failed.
            //return Redirect::back();//->with($validation);
        } else {
            $form = Input::all();
            $produtos = Produtos::find($id);

            if(!($produtos->id_pro)) return App::abort(404);

            $produtos->id_ptp_pro = $form['id_ptp_pro'];
            $produtos->nome_pro = $form['nome_pro'];
            $produtos->descricao_pro = $form['descricao_pro'];
            $produtos->status_pro = $form['status_pro'];
            $resp = $produtos->save();

            if ($resp) {
                //Upload->
                $id = $produtos->id_pro;//seleciona id da submissão referente
                $titulo = ConteudoController::CharSP($produtos->nome_pro); //Usa o titulo do trabalho como nome de arquivo
                $fileName = 'nome_arq';
                if(Input::hasFile($fileName)){
                    $arquivos   = Arquivos::where('id_fk_arq', $id)->first();
                    //$titulo    .= (($arquivos->count())?$arquivos->count():'');

                    if ($arquivos->id_arq) {//remove o arquivo anterior
                        $file = $_SERVER['DOCUMENT_ROOT'].$arquivos->caminho_arq.'/'.$arquivos->nome_arq;
                        if (file_exists($file)) {
                            unlink($file);
                        }
                    }

                    $idArea     = 'produtos';
                    //retorna "Upload não realizado! Arquivo não encontrado!" se o usuario não enviar o arquivo
                    $respUp = ConteudoController::Uploader($fileName, $id, $titulo, $idArea);
                    $error['respUp'] = $respUp['error'];

                    if ($respUp['resp']) {
                        if (!($arquivos->id_arq)) {
                            $arquivos = new Arquivos();
                        }
                        $arquivos->nome_arq = $respUp['nome'];
                        $arquivos->id_fk_arq = $id;
                        //$arquivos->id_ars_arq = $idArea;
                        $arquivos->caminho_arq = $respUp['caminho'];
                        $respArquivos = $arquivos->save();
                    }
                }
                //Upload<-
            }
        }

        $acao = 'atualizado';
        if ($resp)          {$menssagem[] = '<b>'.$produtos->nome_pro.'</b> '.$acao.' com sucesso!';}
        else                {$menssagem[] = 'Ops! Um <b>problema</b> aconteceu. <b>Tente novamente</b> mais tarde.';}
        if ($respArquivos)  {$menssagem[] = 'Arquivo <b>'.$arquivos->nome_arq.'</b> foi adicionado com sucesso!';}

        $resp = json_encode(array(
            'resp'      => $resp,
            'mensagem'  => $menssagem,
            'id'        => $id,
        ));
        //return var_dump($resp);
        return Redirect::to('produtos')
            ->with(array('resp' => $resp))
            ;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        if($id>0) {
            $produtos = Produtos::find($id);
            $resp = $produtos->delete();

            $acao = 'deletado';
            if ($resp) {$menssagem[] = '<b>'.$produtos->nome_pro.'</b> '.$acao.' com sucesso!';}
            else       {$menssagem[] = 'Ops! Um <b>problema</b> aconteceu. <b>Tente novamente</b> mais tarde.';}

            $resp = json_encode(array(
                'resp'      => $resp,
                'mensagem'  => $menssagem,
                'id'        => $id,
            ));

            /*if ($resp){
                return Redirect::to('produtos')
                    ->with(array('resp' => $resp))
                ;
            } else {
            }*/

            //Recarrega pagina via jQuery na view
            return $resp;
        }
	}

}