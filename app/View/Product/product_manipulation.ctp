<!-- Lib reponsible for item of detais -->
<?php $this->Html->css('Library/Summernote/font-awesome/font-awesome.min', array('inline' => false)); ?>
<?php $this->Html->css('Library/Summernote/summernote', array('inline' => false)); ?>
<?php $this->Html->script('Library/Summernote/summernote.min', array('inline' => false)); ?>
<?php $this->Html->script('Library/Summernote/plugin/summernote-ext-hello', array('inline' => false)); ?>
<?php $this->Html->script('Library/Summernote/plugin/summernote-ext-hint', array('inline' => false)); ?>
<?php $this->Html->script('Library/Summernote/plugin/summernote-ext-video', array('inline' => false)); ?>

<?php echo $this->Html->css('View/Product.product_manipulation', array('inline' => false)); ?>
<?php echo $this->Html->script('util', array('inline' => false)); ?>
<?php echo $this->Html->script('View/moment', array('inline' => false)); ?>
<?php echo $this->Html->script('View/Product.product_manipulation', array('inline' => false)); ?>
	<?php echo $this->Html->script('jquery.mask'); ?>
		<?php echo $this->Html->script('jquery.mask.min'); ?>
		<?php echo $this->Html->script('View/product_manipulation_2'); ?>


<?php
$navegador = $_SERVER['HTTP_USER_AGENT'];


if (isset($offerInformation)) {
    $offer = $offerInformation['Offer'];


    $offerValueWithDiscount = ((100 - $offer['percentage_discount']) * $offer['value']) / 100;
    $offer['percentage_discount'] = $offerValueWithDiscount == 0 ? "" : $offerValueWithDiscount;
    $offer['begins_at'] = substr($offer['begins_at'], 0, 10);
    $offer['ends_at'] = substr($offer['ends_at'], 0, 10) == '0000-00-00' ? "" : substr($offer['ends_at'], 0, 10);
    if (empty($offer['photo'])) {
       // $offer['photo'] = "http://52.67.24.232/secure/portal/img/jezzy_icons/upload_image.png";
    }


} else {
    $offer = Array
        (
        'id' => '',
        'company_id' => '',
        'title' => '',
        'resume' => '',
        'description' => '',
        'specification' => '',
        'value' => '',
        'percentage_discount' => '',
        'weight' => '',
        'amount_allowed' => '',
        'begins_at' => '',
        'ends_at' => '',
        'photo' => 'http://52.67.24.232/secure/portal/img/jezzy_icons/upload_image.png',
        'metrics' => '',
        'parcels' => '',
        'parcels_off_impost' => '',
        'public' => '',
        'status' => '',
        'sku' => '',
        'parcels_impost_value' => '',
        'offer_attribute_x' => '',
        'offer_attribute_y' => '',
        'category' => ''
    );
}
$insert = false;
if($offer['title'] != ''){
	$insert = true;
}

/*
if($offer['title'] != ''){
			$dataInicio = date('d/m/Y', strtotime($offer['begins_at']));
	$dataFinal = date('d/m/Y', strtotime($offer['ends_at']));
	} */

if (isset($offerExtra)) {
    $offerExtra = $offerExtra['offers_extra_infos'];
} else {
    $offerExtra = Array
        (
        'id' => '',
        'offer_id' => '',
        'delivery_deadline' => '',
        'category_id' => '',
        'delivery_mode' => '',
        'offer_type' => '',
        'offer_orientation' => '',
        'delivery_value' => '',
        'recurrence' => ''
    );
}

if(!isset($offerFilters)){
    $offerFilters = array();
}else{
    $offerFilters = $offerFilters[0]['offers_filters'];
}
$imagesArr = array();
for ($i = 0; $i < 5; $i++) {
    if (isset($offerImages[$i])) {
        $imagesArr[$i]['url'] = $offerImages[$i]['offers_photos']['photo'];
        $imagesArr[$i]['id'] = $offerImages[$i]['offers_photos']['id'];
    } else {
        $imagesArr[$i]['url'] = "jezzy_icons/upload_image.png";
        $imagesArr[$i]['id'] = 0;
    }
}
?>
<h1 class="page-header" id="code" style="margin-top: -38px;">Cadastrar produto/oferta</h1>

<?php
		// print_r($offerService);
 ?>

<?php
$message = $this->Session->flash();
if ($message !== null && $message != "") {
    echo '<div class="alert alert-success centerText" role="alert">' . $message . '</div>';
}
?>
<div <?php if(empty($company['Company']['moip_id'])){echo 'style="display:none;"';}?>>
    <div class="row">
        <div class="col-md-9 ">
            <div class="row">
                <div  class="col-md-12">
                    <div class="row">
                        <div class="col-md-4" data-toggle="buttons">
                            Você vai vender um ...
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4" data-toggle="buttons">
                            <div class="btn-group">
                                <label class="btn btn-default" id="offerTypeProduct" >
                                    <input id="offerTypeProductRadio" type="radio" name="data[Offer][extra_infos][offer_type]" value="PRODUCT" placeholder="Você vai vender um ..." /> <span class="glyphicon glyphicon-cd"> Produto</span>
                                </label>
                                <label class="btn btn-default" id="offerTypeService">
                                    <input id="offerTypeServiceRadio"  type="radio" name="data[Offer][extra_infos][offer_type]" value="SERVICE" placeholder="Você vai vender um ..." /> <span class="glyphicon glyphicon-thumbs-up"> Serviço</span
                                </label>
                            </div>
                        </div>
                        <div class="col-md-8">

						<?php if(empty($offerService)){  ?>
							<select class="form-control" id="services-select">
									<option>Selecione o Serviço</option>
							</select>
						<?php }else{?>

							<select class="form-control" disabled="disabled" >
									<?php  if(!empty($offerService)){ ?>
									<option value=""><?php echo $offerService[0]['subclasses']['name']; ?></option>
									<?php }?>
							</select>

						<?php }?>

                            <input name="data[Offer][title]" type="text" class="form-control require requireFild helper-field" placeholder="Titulo da Oferta" required="required" id="OfferTitle" value="<?php echo $offer['title']; ?>">
                            <small class="text-muted" id="OfferTitleHelper" style="display: none;">Esse será o <var>nome</var> que o usuário verá em seu anúncio.</small>

							<input type="hidden" id="selectedServiceId" name="selectedServiceId" <?php if(!empty($offerService)){ echo 'value="'.$offerService[0]['services']['id'].'"';}?>/>

                            <div style="col-md-12">
                                <div id="search-return" class="return-box">

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 marginTop30">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#sectionA">Resumo</a></li>
                        <li><a data-toggle="tab" href="#sectionB">Descrição</a></li>
                        <li><a data-toggle="tab" href="#sectionC">Especificação</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="sectionA" class="tab-pane fade in active requireFild">
                            <div id="resume" class="form-control helper-field"><?php echo $offer['resume']; ?></div>
                            <small class="text-muted" id="resumeHelper" >Descreva em poucas palavras o seu produto. (Como ele pode ajudar seu cliente? O que oferece?)</small>
                        </div>
                        <div id="sectionB" class="tab-pane fade">
                            <div id="description" class="form-control"><?php echo $offer['description']; ?></div>
                            <small class="text-muted" id="descriptionHelper" >Descreva detalhadamente o seu produto e todas as funções do mesmo.</small>
                        </div>
                        <div id="sectionC" class="tab-pane fade">
                            <div id="specification" class="form-control"><?php echo $offer['specification']; ?></div>
                            <small class="text-muted" id="specificationHelper" >Especifique as caracteristicas de seu produto, detalhadamente. (Tamanho, cor, peso, polegadas, etc)</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 margirTop15" id="divImagesOffer">
            <div class="row">
                <div class="col-md-12 centerText">

                </div>
            </div>
            <div class="row">
                <div class="col-md-6" id="">

                   <!-- <img src="<?php echo $offer['photo']; ?>" class="imageSize" id="principal-editimage" /> -->
					<img src="<?php if(empty($offer['photo'])){ echo "http://52.67.24.232/secure/portal/img/jezzy_icons/upload_image.png";}else{ echo $offer['photo'];}?>" class="imageSize" id="principal-editimage" />
                <?php echo substr($offer['photo'], 0, 4) != "http" ? '' : '<span class="glyphicon glyphicon-remove mousePointer"></span> Remover' ?>
                </div>
                <div class="col-md-6" >
                <?php echo $this->Html->image($imagesArr[0]['url'], array('class' => 'imageSize', 'id' => 'editimage1', 'photo_id' => $imagesArr[0]['id'])); ?>
                <?php echo $imagesArr[0]['id'] == 0 ? '' : '<span id="' . $imagesArr[0]['id'] . '"  class="glyphicon glyphicon-remove mousePointer"></span> Remover' ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6" >
                <?php echo $this->Html->image($imagesArr[1]['url'], array('class' => 'imageSize', 'id' => 'editimage2', 'photo_id' => $imagesArr[1]['id'])); ?>
                <?php echo $imagesArr[1]['id'] == 0 ? '' : '<span id="' . $imagesArr[1]['id'] . '" class="glyphicon glyphicon-remove mousePointer"></span> Remover' ?>
                </div>
                <div class="col-md-6" >
                <?php echo $this->Html->image($imagesArr[2]['url'], array('class' => 'imageSize', 'id' => 'editimage3', 'photo_id' => $imagesArr[2]['id'])); ?>
                <?php echo $imagesArr[2]['id'] == 0 ? '' : '<span id="' . $imagesArr[1]['id'] . '" class="glyphicon glyphicon-remove mousePointer"></span> Remover' ?>
                </div>
            </div><br/>
            <div class="row">
                <div class="col-md-6" >
                <?php echo $this->Html->image($imagesArr[3]['url'], array('class' => 'imageSize', 'id' => 'editimage4', 'photo_id' => $imagesArr[3]['id'])); ?>
                <?php echo $imagesArr[3]['id'] == 0 ? '' : '<span id="' . $imagesArr[1]['id'] . '" class="glyphicon glyphicon-remove mousePointer"></span> Remover' ?>
                </div>
                <div class="col-md-6" >
                <?php echo $this->Html->image($imagesArr[4]['url'], array('class' => 'imageSize', 'id' => 'editimage5', 'photo_id' => $imagesArr[4]['id'])); ?>
                <?php echo $imagesArr[4]['id'] == 0 ? '' : '<span id="' . $imagesArr[1]['id'] . '" class="glyphicon glyphicon-remove mousePointer"></span> Remover' ?>
                </div>
                <input type="file" id="uper"  name="data[Offer][photo]" class="inputFileHide" value="" />
                <input type="file" id="uper5"  name="data[Offer][photos_extra_zero]" class="inputFileHide" value="" />
                <input type="file" id="uper1"  name="data[Offer][photos_extra_one]" class="inputFileHide" value="" style="display: none;">
                <input type="file" id="uper2"  name="data[Offer][photos_extra_two]" class="inputFileHide" value="" style="display: none;"/>
                <input type="file" id="uper3"  name="data[Offer][photos_extra_three]" class="inputFileHide" value=""  style="display: none;"/>
                <input type="file" id="uper4"  name="data[Offer][photos_extra_four]" class="inputFileHide" value=""  style="display: none;"/>

            </div>

        </div>
    </div>
    <div class="row marginTop30 endFormLine">
        <div class="col-md-3">
            <div class="form-group" id="productWeith">
                <input type="number" name="data[Offer][weight]"  class="form-control" id="productWeithInputField" placeholder="Peso Kg" value="<?php echo $offer['weight']; ?>">

                <br/><br/>
                <div class="checkbox">
                    <label><input type="checkbox" value="" disabled="disabled" checked="checked"><strong>Retirar produto no Salão</strong></label>
                </div>
            </div>
            <div class="form-group helper-field" id="productFreight">
                <div class="radio">
                    <label>
                        <input type="radio" name="data[CompanyPreference][use_correios_api]" id="postOfficeOption" value="1" checked>
                        Correios
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="data[CompanyPreference][use_correios_api]" id="postNotOfficeOption" value="2" >
                        Transportadora
                    </label>
                </div>
                <div id="optionIfNotPostOffice">
                    <div class="form-group paddinLeft20">
                        <input name="data[Offer][extra_infos][delivery_dealine]" type="number" class="form-control requireFild" id="delivery_dealine" placeholder="Dias de prazo" value="<?php echo $offerExtra['delivery_deadline'] > 0 ? $offerExtra['delivery_deadline'] : ""; ?>" >
                    </div>
                    <div class="form-group paddinLeft20">
                        <input name="data[Offer][extra_infos][delivery_value]" type="number" class="form-control requireFild" id="delivery_value" placeholder="Valor Frete" value="<?php echo $offerExtra['delivery_value'] > 0 ? $offerExtra['delivery_value'] : ""; ?>" >
                    </div>
                </div>
                <small class="text-muted" id="productFreightHelper" style="display: none;">Defina o serviço de entrega de seus produtos. <br/>- Caso escolha <var>Correios</var> o frete/valor será calculado automaticamente pelo prestador do serviço.<br/>- Caso a escolha seja <var>Transportadora</var> insira um valor fixo para o frete e quantidade de dias para entrega.</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="number" name="data[Offer][value]" class="form-control requireFild helper-field" id="offerPrice" placeholder="Preço Original" required="required" value="<?php echo $offer['value']; ?>">
                <small class="text-muted" id="offerPriceHelper" style="display: none;">Valor do produto <var>sem desconto</var>, será mostrado ao usuário durante o anúncio dessa oferta. <br/></small>
            </div>
            <div class="form-group">
                <input type="number" name="data[Offer][discounted_value]" class="form-control" id="Offer_discounted_value" placeholder="Preço da Oferta" value="<?php echo $offer['percentage_discount']; ?>">
                <small class="text-muted" id="Offer_discounted_valuePriceHelper" style="display: none;">Valor do produto <var>com desconto</var>, será mostrado ao usuário durante o anúncio dessa oferta juntamente com a porcetagem de desconto. <br/></small>
            </div>
            <div class="form-group">
                <div class="btn-group helper-field" data-toggle="buttons" id="divParcelOfferLabel">
                    Esta oferta pode ser parcelada?
                </div>
                <div class="btn-group helper-field" data-toggle="buttons" id="divParcelOffer">
                    <label class="btn btn-default" id="canParcelOfferYes">
                        <input name="data[Offer][parcels]" type="radio" name="paymentMonth" value="ACTIVE" placeholder="Oferta pode ser parcelada?" /> <span> Sim</span>
                    </label>
                    <label class="btn btn-default"  id="canParcelOfferNo">
                        <input name="data[Offer][parcels]" type="radio" name="paymentMonth" value="INACTIVE" placeholder="Oferta pode ser parcelada?" /> <span> Não</span>
                    </label>
                    <input type="number" name="data[Offer][parcel_percentage]" class="form-control width50Porcento" id="parcelOfferPercentage" placeholder="% juros" value="0" style="display: none;">
                    <small class="text-muted" id="divParcelOfferHelper" style="display: none;">Será permitido o <var>parcelamento</var> dessa oferta durante o pagamento do cliente?</small>
                    <small class="text-muted" id="divParcelOfferLabelHelper" style="display: none;">Será permitido o <var>parcelamento</var> dessa oferta durante o pagamento do cliente?</small>
                </div>
            </div>

			 <div class="form-group" id="qtdParcelasPermitidas">
			  <div class="btn-group helper-field" data-toggle="buttons" id="divParcelOfferLabel">
                    Quantidade de parcelas permitidas
                </div>
                <select id="parcels_quantity" name="parcels_quantity" class="form-control">
					<?php $i = 1; while($i <= 12){?>
							<option value="<?php echo $i;?>"><?php echo $i;?></option>
					<?php $i++;}?>
				</select />



            </div>

        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group textCenter">
                        <input required="required" type="number" class="co form-control requireFild helper-field" id="offerQtd" placeholder="Quantidade" value="<?php echo $offer['amount_allowed']; ?>">
                        <small class="text-muted" id="offerQtdHelper" style="display: none;"><var>Quantidade disponivel</var> em estoque para venda de seu produto.<br/></small>
                    </div>
                    <div class="form-group textCenter">
                        <input type="text" class="form-control helper-field" id="offer_sku" placeholder="SKU" name="offer_sku" value="<?php //echo $offer['SKU']; ?>">
                        <small class="text-muted" id="offer_skuHelper" style="display: none;">Insira aqui o <var>indificador único</var> usado para esse produto.<br/></small>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 ">
                    <div class="borderTagetOffer textCenter">
                        <p>Definir publico alvo</p>
                        <p class="fontTextTopTargetOffer">Sua oferta pode ser direcionada para um perfil de publico especifico. Quanto mais certeiro for o alvo maiores são as chences de realizar novas vendas.</p>
                        <button type="button" class="btn btn-primary" id="targetOffer">Oferta direcionada  </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group textCenter">
                        <label for="exampleInputEmail1">Validade da oferta</label>
                        <br>
                        <span  class="fontTextTopTargetOffer"> Inicio</span>
                        <input name="data[Offer][begins_at]" id="dateHtmlBegin" type="date" class="form-control" id="" placeholder="Inicio" value="<?php echo $offer['begins_at']; ?>" onkeyup="
        var v = this.value;
        if (v.match(/^\d{2}$/) !== null) {
            this.value = v + '/';
        } else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
            this.value = v + '/';
        }"
    maxlength="10">
                    </div>
                    <div class="form-group textCenter margirTop15negative">
                        <span  class="fontTextTopTargetOffer"> Fim</span>
                        <input name="data[Offer][ends_at]" type="date" id="dateHtmlEnd" class="form-control" id="" placeholder="Fim" value="<?php echo $offer['ends_at']; ?>"  onkeyup="
        var v = this.value;
        if (v.match(/^\d{2}$/) !== null) {
            this.value = v + '/';
        } else if (v.match(/^\d{2}\/\d{2}$/) !== null) {
            this.value = v + '/';
        }"
    maxlength="10">
                    </div>
                    <!-- para ofertas sem fim previsto -->
                    <div class="form-group textCenter margirTop15negative">
                        <div class="checkbox">
                            <label><input type="checkbox" value="" id="offerNoEnds">Oferta sem fim previsto</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row textCenter">
                <div class="col-md-12">
                    <div class="borderTagetOffer">

                        <div class="">
                            <span > Opções do produto</span>
                        </div>
                        <div class="">
                            <span class="fontTextTopTargetOffer">Adicionar Opções de categoria, aplicação, etc</span>
                        </div>
                        <button type="button"  class="btn btn-default" id="addOptionOnOffer">Adicionar Opções</button>
                    </div>

                </div>
            </div>
            <div class="col-md-12 help-icon">

				<?php echo $this->Html->image('jezzy_icons/help-icon.png'); ?>
            </div>
        </div>
    </div>

    <div class="panel-body">
        <input type="hidden" id="offer_type_jquery" value="<?php echo $offerExtra['offer_type'] ?>" />
        <input type="hidden" id="use_correios_api_jquery" value="<?php echo $offerExtra['delivery_mode'] ?>" />
        <input type="hidden" id="offer_parcels_jquery" value="<?php echo $offer['parcels'] ?>" />
        <input type="hidden" name="data[Offer][id]" id="offer_id" value="<?php echo $offer['id']; ?>" />
        <input type="hidden" id="gender" name="data[Offer][filters][gender]" />
        <input type="hidden" id="location" name="data[Offer][filters][location]"/>
        <input type="hidden" id="religion" name="data[Offer][filters][religion]"/>
        <input type="hidden" id="political" name="data[Offer][filters][political]"/>
        <input type="hidden" id="age_group" name="data[Offer][filters][age_group]"/>
        <input type="hidden" id="relationship_status" name="data[Offer][filters][relationship_status]" />
        <button type="submit" class="btn btn-primary pull-right" id="saveProduct">Salvar</button>
    </div>


    <div id="divMessageErrorOffer" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" id="modelContent">
                <div class="modal-header formModalError" id="errorModalHeader">
                    Foi encontrado um erro no fomulário.
                </div>
                <div class="modal-body" id="alertContent">

                </div>
            </div>
        </div>
    </div>


<div id="myModalOfferQuestions" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="min-width:1050px;" id="modelContent">
            <div class="modal-header textCenter">
                <span class="titleModelOption">
                    Características Adicionais
                </span>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="modal-body col-md-12">
                            <!--formulário offers_questions save with offer_id-->
                            <div class="form-group col-md-3" >
                                <span>Tipo de Cabelo:</span>
                                    <br/>
                                    <br/>
                                 <?php if (!empty($offerCategories)){
                                     $offerquestions = $offerCategories[0]['offers_questions']['hair_type'];
                                     $offer_questions = explode(";", $offerquestions);
                                     foreach($offer_questions as $offer_question){
                                        $selected[$offer_question] = 'checked="checked"';
                                     }
                                    }
                                    ?>
                                      <?php
                                            $hairtypes = explode(';', $offerQuestions[0]['offers_characteristics']['hair_type']);

                                            foreach($hairtypes as $hairtype){
                                                if($hairtype === 'straight'){
                                                    $hairtypek = 'Liso';
                                                }else if($hairtype === 'wavy/curly/kcc'){
                                                     $hairtypek = 'Crespo/Cacheado/Ondulado';
                                                }else if($hairtype === 'color/whitening'){
                                                     $hairtypek = 'Coloridos/Descoloridos';
                                                }else if($hairtype === 'damaged/weak/brittle'){
                                                     $hairtypek = 'Danificados/Fracos/Quebradiços';
                                                }else if($hairtype === 'aged/opaque'){
                                                     $hairtypek = 'Envelhecidos/Opacos';
                                                }else if($hairtype === 'thin'){
                                                     $hairtypek = 'Finos';
                                                }else if($hairtype === 'undisciplined/beaded/unruly'){
                                                     $hairtypek = 'Indisciplinados/Frisados/Rebeldes';
                                                }else if($hairtype === 'blond/grey'){
                                                     $hairtypek = 'Loiros e Grisalhos';
                                                }else if($hairtype === 'mixed'){
                                                     $hairtypek = 'Mistos';
                                                }else if($hairtype === 'normal'){
                                                     $hairtypek = 'Normais';
                                                }else if($hairtype === 'oily'){
                                                     $hairtypek = 'Oleosos';
                                                }else if($hairtype === 'chemically-treated'){
                                                     $hairtypek = 'Quimicamente Tratados';
                                                }else if($hairtype === 'dry'){
                                                     $hairtypek = 'Secos/Ressecados';
                                                }else if($hairtype === 'all'){
                                                     $hairtypek = 'Todos';

                                                }

                                                 if(!empty($selected[$hairtype])){

                                                }else{
                                                     $selected[$hairtype] = ' ';
                                                }
                                                 if(!empty($hairtype)){


                                                        echo '<label class="checkbox-inline"><input '.$selected[$hairtype].' type="checkbox" name="hairtype" value="'.$hairtype.'">'.$hairtypek.'</label><br/>';


                                                }

                                            }
                                    ?>

                                </select>
                            </div>


                            <div class="form-group col-md-3">
                                <span>Aplicação:</span>
                                    <br/>
                                    <br/>
                                     <?php if (!empty($offerCategories)){
                                     $offerquestions = $offerCategories[0]['offers_questions']['application'];
                                     $offer_questions = explode(";", $offerquestions);
                                     foreach($offer_questions as $offer_question){
                                          $selected[$offer_question] = 'checked="checked"';

                                     }


                                    }
                                    ?>
                                      <?php
                                            $hairtypes = explode(';', $offerQuestions[0]['offers_characteristics']['application']);

                                            foreach($hairtypes as $hairtype){
                                                if($hairtype === 'anti-dandruf'){
                                                    $hairtypek = 'Anticaspa';
                                                }else if($hairtype === 'anti-hairloss'){
                                                     $hairtypek = 'Antiqueda';
                                                }else if($hairtype === 'curls activation'){
                                                     $hairtypek = 'Ativação de Cachos';
                                                }else if($hairtype === 'anti-frizz/defrizzer'){
                                                     $hairtypek = 'Defrizante/Anti-frizz';
                                                }else if($hairtype ==='progressive-brush'){
                                                    $hairtypek = 'Escova Progressiva';
                                                }else if($hairtype ==='hydration/nutrition'){
                                                    $hairtypek = 'Hidratação/Nutrição';
                                                }else if($hairtype ==='cleaning'){
                                                    $hairtypek = 'Limpeza';
                                                }else if($hairtype ==='thermal-protection'){
                                                    $hairtypek = 'Proteção Térmica';
                                                }else if($hairtype ==='solar-protection'){
                                                    $hairtypek = 'Proteção Solar';
                                                }else if($hairtype ==='capillary-reconstruction'){
                                                    $hairtypek = 'Reconstrução Capilar';
                                                }else if($hairtype ==='hair ends repair'){
                                                    $hairtypek = 'Reparador de Pontas';
                                                }else if($hairtype ==='unsalted-treatment'){
                                                    $hairtypek = 'Tratamento Sem Sal';
                                                }
                                                  if(!empty($selected[$hairtype])){

                                                }else{
                                                     $selected[$hairtype] = ' ';
                                                }
                                                if(!empty($hairtype)){
                                                     if(empty($offerCategories)){
                                                          if($hairtypek=='Cabelos Normais'){
                                                        echo '<label class="checkbox-inline"><input '.$selected[$hairtype].' type="checkbox" name="application" value="'.$hairtype.'" >'.$hairtypek.'</label><br/>';
                                                    }else{
                                                        echo '<label class="checkbox-inline"><input '.$selected[$hairtype].' type="checkbox" name="application" value="'.$hairtype.'">'.$hairtypek.'</label><br/>';
                                                    }
                                                     }else{
                                                          echo '<label class="checkbox-inline"><input type="checkbox" '.$selected[$hairtype].' name="application" value="'.$hairtype.'">'.$hairtypek.'</label><br/>';
                                                     }

                                                }

                                            }
                                    ?>

                            </div>


                            <div class="form-group col-md-3">
                                <span>Categoria do Produto:</span>
                                <br/>
                                <br/>
                                     <?php if (!empty($offerCategories)){


                                     $offerquestions = $offerCategories[0]['offers_questions']['product_categories'];
                                     $offer_questions = explode(";", $offerquestions);
                                     foreach($offer_questions as $offer_question){
                                          $selected[$offer_question] = 'checked="checked"';

                                     }


                                    }
                                    ?>

                                      <?php
                                            $hairtypes = explode(';', $offerQuestions[0]['offers_characteristics']['product_categories']);

                                            foreach($hairtypes as $hairtype){
                                                if($hairtype === 'ampoule'){
                                                    $hairtypek = 'Ampolas';
                                                }else if($hairtype === 'conditionare'){
                                                     $hairtypek = 'Condicionadores';
                                                }else if($hairtype === 'cream'){
                                                     $hairtypek = 'Cremes';
                                                }else if($hairtype === 'finisher'){
                                                     $hairtypek = 'Finalizadores';
                                                }else if($hairtype === 'gel'){
                                                     $hairtypek = 'Gel';
                                                }else if($hairtype === 'kit'){
                                                     $hairtypek = 'Kits';
                                                }else if($hairtype === 'leavein'){
                                                     $hairtypek = 'Leave-in';
                                                }else if($hairtype === 'mask'){
                                                     $hairtypek = 'Máscaras';
                                                }else if($hairtype === 'mousse'){
                                                     $hairtypek = 'Mousse';
                                                }else if($hairtype === 'oil'){
                                                     $hairtypek = 'Óleos e Sérum';
                                                }else if($hairtype === 'pomade'){
                                                     $hairtypek = 'Pomadas e Ceras';
                                                }else if($hairtype === 'shampoo'){
                                                     $hairtypek = 'Shampoo';
                                                }else if($hairtype === 'spray'){
                                                     $hairtypek = 'Spray';
                                                }else if($hairtype === 'modeler'){
                                                     $hairtypek = 'Modeladores';
                                                }
                                                if(!empty($selected[$hairtype])){

                                                }else{
                                                     $selected[$hairtype] = ' ';
                                                }

                                                  if(!empty($hairtype)){
                                                    echo '<label class="checkbox-inline"><input '.$selected[$hairtype].' type="checkbox" name="product_categories" value="'.$hairtype.'">'.$hairtypek.'</label><br/>';
                                                }
                                            }
                                    ?>

                            </div>

                           <div class="form-group col-md-3">
                                <span>Publico:</span>
                                <br/>
                                <br/>
                                     <?php if (!empty($offerCategories)){


                                     $offerquestions = $offerCategories[0]['offers_questions']['public'];
                                     $offer_questions = explode(";", $offerquestions);
                                     foreach($offer_questions as $offer_question){
                                          $selected[$offer_question] = 'checked="checked"';

                                     }

                                                                           }
                                    ?>

                                      <?php
                                            $hairtypes = explode(';', $offerQuestions[0]['offers_characteristics']['public']);

                                            foreach($hairtypes as $hairtype){
                                                if($hairtype === 'female'){
                                                    $hairtypek = 'Feminino';
                                                }else if($hairtype === 'male'){
                                                     $hairtypek = 'Masculino';
                                                }else if($hairtype === 'unissex'){
                                                     $hairtypek = 'Unissex';
                                                }
                                                  if(!empty($selected[$hairtype])){

                                                }else{
                                                     $selected[$hairtype] = ' ';
                                                }
                                                  if(!empty($hairtype)){
                                                    echo '<label class="radio-inline"><input '.$selected[$hairtype].' type="radio" name="public" value="'.$hairtype.'">'.$hairtypek.'</label><br/>';
                                                }
                                            }
                                    ?>

                            </div>
                            <br/>
                            <br/>
                           <input type="hidden" name="offer_id_modal" id="offer_id_modal" value="<?php echo $offer['id']; ?>" />
                    </div>
                     <button type="button" id="offers_questionsSaveButton" class="btn btn-primary floatRight">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>



    <div id="myModalOfferTarget" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-lg" >
            <div class="modal-content" id="modelContent">
                <div class="modal-header textCenter">
                    <span class="titleModelOption">
                        Oferta direcionada
                    </span>
                </div>
                <div class="modal-body">
                    <form action="" target="" method="post" id="offerTargetOptions">

                        <div class="row margirTop15">
                            <div class="col-md-12">
                                <label for="Genero">Genero: </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn-group" data-toggle="buttons">
                                <?php
                                if(isset($offerCategories[0]['offers_questions']['public'])){
                                    $genderArr = explode(";", $offerCategories[0]['offers_questions']['public']);
                                    
                                }else{
                                    $genderArr['gender'] = array();
                                }
                                if(isset($filters['gender'])){
                                    foreach ($filters['gender'] as $filter){
                                        $active = in_array($filter['param'], $genderArr)? 'active' : '';
                                        $checked = in_array($filter['param'], $genderArr)? 'checked="checked"' : '';
                                        $gender = $filter['param'] == 'male' ? 'Masculino' :  'Feminino';
                                        echo '
                                            <label class="btn btn-primary ' . $active . '">
                                                <input ' . $checked . ' name="gender[]"     value="'.$filter['param'].'" type="checkbox" autocomplete="off"> ' . $gender . ' - ' . $filter['total'] . '%
                                            </label>';
                                    }
                                }
                                ?>
                                </div>
                            </div>
                        </div>




                        <div class="row margirTop15">
                            <div class="col-md-12">
                                <label for="Genero">Idade: </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="btn-group" data-toggle="buttons">

                                <?php
                                if(isset($offerFilters['age_group'])){
                                  
                                    $repetArr = explode(",", $offerFilters['age_group']);
                                }else{
                                    $repetArr['age'] = array();
                                }
                                if(isset($filters['age'])){
                                    foreach ($filters['age'] as $key => $filter){
                                        $filter['param'] = $filter['param'] == "" ? 'outro' : $filter['param'];
                                    
                                       
                                        $active = in_array($filter['param'], $repetArr) ? 'active' : '';
                                        $checked = in_array($filter['param'] , $repetArr) ? 'checked="checked"' : '';
                                       
                                       
                                        echo'
                                            <label class="btn btn-primary ' . $active . '">
                                                <input ' . $checked . ' name="age[]" value="' . $filter['param'] . '" type="checkbox" autocomplete="off"> ' . $filter['param'] . ' - ' . $filter['total'] . '%
                                            </label>' ;
                                       
                                    }
                                     
                                }
                                ?>
                                </div>
                            </div>
                        </div>

                        <div class="row margirTop15">
                                               <div class="col-md-12">
                                                   <label for="Genero">Tipo de Cabelo: </label>
                                               </div>
                                           </div>

                                           <div class="row">
                                               <div class="col-md-12">
                                                   <div class="btn-group" data-toggle="buttons">

                                                       <?php
                                                       if(isset($offerQuestions[0]['offers_characteristics']['hair_type'])){
                                                           $repetArr = explode(";", $offerQuestions[0]['offers_characteristics']['hair_type']);
                                                       }else{
                                                           $repetArr['hair_type'] = array();
                                                       }
                                                         if(isset($filters['hair_type'])){

                                                           foreach ($filters['hair_type'] as $key => $filter){

                                                               $filter['param'] = $filter['param'] == "" ? 'Outro' : $filter['param'];
                                                               if(isset($offerCategories)){
                                                               $offerquestions = $offerCategories[0]['offers_questions']['hair_type'];
                                                               $offer_questions = explode(";", $offerquestions);

                                                               foreach($offer_questions as $offer_questioned){

                                                               $checked[$offer_questioned] = 'checked="true"';
                                                               $active[$offer_questioned] = 'active';

                                                               }
                                                               }
                                                               // $active = in_array($key, $repetArr) ? 'active' : '';
                                                               //$checked = in_array($key, $repetArr) ? 'checked="false"' : '';
                                                               $o = $filter['param'];

                                                                switch ($filter['param']) {
                                                                   case 'straight':
                                                                        $filter['param']= "Liso";
                                                                       break;
                                                                   case 'damaged/weak/brittle':
                                                                        $filter['param'] = "Danificado/Fraco/Quebradiço";
                                                                       break;
                                                                   case 'color/whitening':
                                                                       $filter['param'] = "Colorido/Descolorido";
                                                                       break;
                                                                    case 'wavy/curly/kcc':
                                                                        $filter['param'] = "Crespo/Cacheado/Ondulado";
                                                                       break;
                                                                   case 'aged/opaque':
                                                                        $filter['param'] = "Envelhecido/Opaco";
                                                                       break;
                                                                   case 'thin':
                                                                        $filter['param'] = "Fino";
                                                                       break;
                                                                   case 'blond/grey':
                                                                        $filter['param'] = "Loiros e Grisalhos";
                                                                       break;
                                                                   case 'chemically-treated':
                                                                        $filter['param'] = "Quimicamente Tratado";
                                                                       break;
                                                                   case 'oily':
                                                                        $filter['param'] = "Oleoso";
                                                                       break;
                                                                   case 'dry':
                                                                        $filter['param'] = "Seco/Ressecado";
                                                                       break;
                                                                   case 'mixed':
                                                                        $filter['param'] = "Misto";
                                                                       break;
                                                                    case 'undisciplined/beaded/unruly':
                                                                        $filter['param'] = "Indisciplinado/Frisado/Rebelde";
                                                                       break;
                                                                   case 'all':
                                                                        $filter['param'] = "Todos";
                                                                       break;
                                                                   case 'normal':
                                                                        $filter['param'] = "Normal";
                                                                       break;
                                                           }

                                                            if(!empty($checked[$o])){

                                                            }else{
                                                                $checked[$o] = '';
                                                            }
                                                                if(!empty($active[$o])){

                                                            }else{
                                                                $active[$o] = '';
                                                            }


                                                               echo '
                                                                   <label class="btn btn-primary ' . $active[$o]. '">
                                                                       <input ' . $checked[$o] . ' name="hair_type[]" value="' . $o . '" type="checkbox" autocomplete="off"> ' . $filter['param'] . ' - ' . $filter['total'] . '%
                                                                   </label>';

                                                           }
                                                       }


                                                       ?>
                                                   </div>
                                               </div>
                                           </div>

                        <div class="row margirTop15">
                            <div class="col-md-12">
                                <input type="hidden" name="offers_filters_id" value="<?php echo isset($offerFilters['id']) ? $offerFilters['id'] : ''; ?>" />
                                <button type="submit" class="btn btn-primary floatRight">Salvar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="loading">
    <?php echo $this->Html->image('loading.gif', array('class' => 'waitGifSize', 'id' => 'loading-image', 'alt' => 'waiting ...')); ?>
    </div>
</div>

<div class="text-center" <?php if(!empty($company['Company']['moip_id'])){echo 'style="display:none;"';}?>>
    <div class="jumbotron col-md-5" id="notFoundMoipAccount">
  <p>A criação de oferta só está disponível para clientes cadastrados no MoIP. <br/>
      Para continuar <a href="../dashboard/index?createMoipAccount=true">realize seu cadastro</a></p>
</div>
</div>
