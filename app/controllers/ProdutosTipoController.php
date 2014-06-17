<?php

class ProdutosTipoController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $produtosTipo = ProdutosTipo::orderBy('nome_ptp', 'ASC')->orderBy('id_ptp', 'DESC')->paginate(10);
        return View::make('ListProdutosTipo')
            ->with(Config::get('Globals'))
            ->with(
                array(
                    'produtosTipo' => $produtosTipo
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
        return View::make('SetProdutosTipo')
            ->with(Config::get('Globals'))
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
            'nome_ptp' => array('required', 'min:3'),
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails())
        {
            // Validation has failed.
            //return Redirect::back();//->with_input()->with_errors($validation);
            //$mensagem[] = $validation;
        } else {
            $form = Input::all();
            $produtosTipo = new ProdutosTipo();
            $produtosTipo->nome_ptp = $form['nome_ptp'];
            $produtosTipo->status_ptp = $form['status_ptp'];
            $produtosTipo->first_date_ptp = date("Y-m-d");
            $resp = $produtosTipo->save();
        }

        $id = $produtosTipo->id_ptp;
        $acao = 'inserido';
        if ($resp) {$menssagem[] = '<b>'.$produtosTipo->nome_ptp.'</b> '.$acao.' com sucesso!';}
        else       {$menssagem[] = 'Ops! Um <b>problema</b> aconteceu. <b>Tente novamente</b> mais tarde.';}

        $resp = json_encode(array(
            'resp'      => $resp,
            'mensagem'  => $menssagem,
            'id'        => $id,
        ));
        //return var_dump($resp);
        return Redirect::to('tipos')
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

        $produtosTipo       = ProdutosTipo::find($id);

        if(!($produtosTipo->id_ptp)) return App::abort(404);

        return View::make('SetProdutosTipo')
            ->with(Config::get('Globals'))
            ->with(
                array(
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
            'nome_ptp' => array('required', 'min:3'),
        );

        $validation = Validator::make(Input::all(), $rules);

        if ($validation->fails())
        {
            // Validation has failed.
            //return Redirect::back();//->with($validation);
        } else {
            $form = Input::all();
            $produtosTipo = ProdutosTipo::find($id);

            if(!($produtosTipo->id_ptp)) return App::abort(404);

            $produtosTipo->nome_ptp = $form['nome_ptp'];
            $produtosTipo->status_ptp = $form['status_ptp'];
            $resp = $produtosTipo->save();
        }


        $id = $produtosTipo->id_ptp;
        $acao = 'atualizado';
        if ($resp) {$menssagem[] = '<b>'.$produtosTipo->nome_ptp.'</b> '.$acao.' com sucesso!';}
        else       {$menssagem[] = 'Ops! Um <b>problema</b> aconteceu. <b>Tente novamente</b> mais tarde.';}

        $resp = json_encode(array(
            'resp'      => $resp,
            'mensagem'  => $menssagem,
            'id'        => $id,
        ));
        //return var_dump($resp);
        return Redirect::to('tipos')
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
            $produtosTipo = ProdutosTipo::find($id);
            $resp = $produtosTipo->delete();

            //Recarrega pagina via jQuery na view
            return json_encode(array(
                'id'=>$id,
                'resp'=>$resp,
            ));
        }
    }

}