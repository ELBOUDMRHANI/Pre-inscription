@extends('layout.app')
@section('title', '| profil')
@section('content')



        <div class="col-xs-12">
            <!-- PAGE CONTENT BEGINS -->
            <div class="clearfix">
                <div class="pull-left alert alert-success no-margin alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">
                        <i class="ace-icon fa fa-times"></i>
                    </button>

                    <i class="ace-icon fa fa-umbrella bigger-120 blue"></i>
                    @lang('profil.msg_info')
                </div>


                </div>

        <div id="user-profile-2" class="user-profile">
            <div class="tabbable">
                <ul class="nav nav-tabs padding-18">
                    <li class="active">
                        <a data-toggle="tab" href="#infoperso">
                            <i class="green ace-icon fa fa-user bigger-120"></i>
                            informations personnel
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#bac">
                            <i class="orange ace-icon fa fa-rss bigger-120"></i>
                            information bac
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#parent">
                            <i class="blue ace-icon fa fa-users bigger-120"></i>
                           Dossier amo
                        </a>
                    </li>

                    <li>
                        <a data-toggle="tab" href="#autre">
                            <i class="pink ace-icon fa fa-picture-o bigger-120"></i>
                            Autre informations
                        </a>
                    </li>
                </ul>
                <form class="form" action="{{url('modif/'.$etudiant[0]->id_etudiant)}}" method="post" enctype="multipart/form-data" >
                    <input type="hidden" name="_method" value="PUT">
                    {{csrf_field()}}
              <div class="tab-content no-border padding-24">

                    <div id="infoperso" class="tab-pane in active">
                        {{csrf_field()}}
                        <div class="row">

                            <div class="col-xs-12 col-sm-3 center">

															<span class="profile-picture">
																<!--<img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="{{--asset('assets/images/avatars/profile-pic.jpg')--}}" />-->
																<?php $path=$etudiant[0]->photo_etudiant;?>

                                                                <?php if($path==null){?>
                                                                <img  class="editable img-responsive" style="width: 180px;height: 200px;"  alt="Alex's Avatar" id="ava" src="{{asset('assets/images/avatars/profile-pic.jpg')}}" />
                                                                <?php } if($path!=null){?>
                                                                <img class="editable img-responsive" alt="Alex's Avatar" id="ava" src="{{asset($path)}}" />
                                                                <?php }?>
															</span>

                                <div class="space space-4">


                                </div>

                              <!--  <a href="#" class="btn btn-sm btn-block btn-success">
                                    <i class="ace-icon fa fa-plus-circle bigger-120"></i>
                                    <span class="bigger-110">Add as a friend</span>
                                </a>

                                <a href="#" class="btn btn-sm btn-block btn-primary">
                                    <i class="ace-icon fa fa-envelope-o bigger-110"></i>
                                    <span class="bigger-110">Send a message</span>
                                </a>
                                -->
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        Upload Validation Error<br><br>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                    </div>
                                    <div class="custom-file">
                                        <div class="col-xs-12">
                                            <input type="file" id="id-input-file-2" name="image_profile"/>
                                        </div>
                                        <label class="custom-file-label" for="inputGroupFile01">Choix d'image</label>
                                    </div>
                                </div>
                            </div><!-- /.col -->


                            <div class="col-xs-12 col-sm-9">
                                <h4 class="blue">
                                    <span style="margin-left: 2px;" class="middle">{{$etudiant[0]->nom_prenom_etud_fr}}</span>

																<span class="label label-purple arrowed-in-right">
																	<i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
                                                                    <?php
                                                                    $etat=$etudiant[0]->validation;
                                                                    if($etat==0){?>
                                                                    @lang('profil.inscrit')
                                                                    <?php }
                                                                    if($etat==1){?>

                                                                    @lang('profil.deja_inscrit')
                                                                <?php }?>

																</span>
                                </h4>

                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">  @lang('profil.cin')</div>

                                        <div class="profile-info-value">
                                            <input type="text" class="form-control" name="cin" value="{{$etudiant[0]->cni_etudiant}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">   @lang('profil.code_massar') </div>

                                        <div class="profile-info-value">
                                            <input type="text" class="form-control" name="code_massar" value="{{$etudiant[0]->code_massar}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">  @lang('profil.nom') </div>

                                        <div class="profile-info-value">
                                            <input type="text" class="form-control" name="nom" value="{{$etudiant[0]->nom_etudiant_fr}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">  @lang('profil.prenom') </div>

                                        <div class="profile-info-value">
                                            <input type="text" class="form-control" name="prenom" value="{{$etudiant[0]->prenom_etudiant_fr}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">  @lang('profil.nom_prenom') </div>

                                        <div class="profile-info-value">
                                            <input type="text" class="form-control" name="nom_prenom" value="{{$etudiant[0]->nom_prenom_etud_fr}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">  @lang('profil.nomar') </div>

                                        <div class="profile-info-value">
                                            <input type="text" class="form-control" name="nomar" value="{{$etudiant[0]->nom_etudiant_ar}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">  @lang('profil.prenomar') </div>

                                        <div class="profile-info-value">
                                            <input type="text" class="form-control" name="prenomar" value="{{$etudiant[0]->prenom_etudiant_ar}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">  @lang('profil.datenaissance') </div>

                                        <div class="profile-info-value">
                                            <input type="text" class="form-control" name="datenaissance" value="{{$etudiant[0]->date_naissance_etud}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">  @lang('profil.villenaiss') </div>

                                        <div class="profile-info-value">
                                            <input type="text" class="form-control" name="villenaiss" value="{{$etudiant[0]->ville_naissance_etud}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">  @lang('profil.adresseperso')  </div>

                                        <div class="profile-info-value">
                                            <input type="text" class="form-control" name="adressperso" value="{{$etudiant[0]->adresse_personnelle_etud}}"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">  @lang('profil.email')  </div>

                                        <div class="profile-info-value">
                                            <input type="text" class="form-control" name="email" value="{{$etudiant[0]->email_etudiant}}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">  @lang('profil.gsm')  </div>

                                        <div class="profile-info-value">
                                            <input type="text" class="form-control" name="gsm" value="{{$etudiant[0]->tel_mobile_etudiant}}"/>
                                        </div>
                                    </div>
                                </div> <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">  @lang('profil.fixe')  </div>

                                        <div class="profile-info-value">
                                            <input type="text" class="form-control" name="fixe" value="{{$etudiant[0]->tel_fixe_etudiant}}"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">  @lang('profil.code_postal')  </div>

                                        <div class="profile-info-value">
                                            <input type="text" class="form-control" name="code_postal" value="{{$etudiant[0]->code_postal}}" />
                                        </div>
                                    </div>
                                </div>



                               <!-- <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name"> Website </div>

                                        <div class="profile-info-value">
                                            <a href="#" target="_blank">www.alexdoe.com</a>
                                        </div>
                                    </div>
                                    <!--
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">
                                            <i class="middle ace-icon fa fa-facebook-square bigger-150 blue"></i>
                                        </div>

                                        <div class="profile-info-value">
                                            <a href="#">Find me on Facebook</a>
                                        </div>
                                    </div>

                                    <div class="profile-info-row">
                                        <div class="profile-info-name">
                                            <i class="middle ace-icon fa fa-twitter-square bigger-150 light-blue"></i>
                                        </div>

                                        <div class="profile-info-value">
                                            <a href="#">Follow me on Twitter</a>
                                        </div>
                                    </div>-->


                           <div>
                               <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                           </div>
                            </div>
                            <div class="hr hr10 hr-double"></div>
                    </div>
                        </div><!-- /#home -->

                      <div id="bac" class="tab-pane ">
                          {{csrf_field()}}
                          <div class="row">

                                <!--<div class="profile-activity clearfix">
                                    <div>
                                        <img class="pull-left" alt="Alex Doe's avatar" src="assets/images/avatars/avatar5.png" />
                                        <a class="user" href="#"> Alex Doe </a>
                                        changed his profile photo.
                                        <a href="#">Take a look</a>

                                        <div class="time">
                                            <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                            an hour ago
                                        </div>
                                    </div>

                                    <div class="tools action-buttons">
                                        <a href="#" class="blue">
                                            <i class="ace-icon fa fa-pencil bigger-125"></i>
                                        </a>

                                        <a href="#" class="red">
                                            <i class="ace-icon fa fa-times bigger-125"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="profile-activity clearfix">
                                    <div>
                                        <img class="pull-left" alt="Susan Smith's avatar" src="assets/images/avatars/avatar1.png" />
                                        <a class="user" href="#"> Susan Smith </a>

                                        is now friends with Alex Doe.
                                        <div class="time">
                                            <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                            2 hours ago
                                        </div>
                                    </div>

                                    <div class="tools action-buttons">
                                        <a href="#" class="blue">
                                            <i class="ace-icon fa fa-pencil bigger-125"></i>
                                        </a>

                                        <a href="#" class="red">
                                            <i class="ace-icon fa fa-times bigger-125"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="profile-activity clearfix">
                                    <div>
                                        <i class="pull-left thumbicon fa fa-check btn-success no-hover"></i>
                                        <a class="user" href="#"> Alex Doe </a>
                                        joined
                                        <a href="#">Country Music</a>

                                        group.
                                        <div class="time">
                                            <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                            5 hours ago
                                        </div>
                                    </div>

                                    <div class="tools action-buttons">
                                        <a href="#" class="blue">
                                            <i class="ace-icon fa fa-pencil bigger-125"></i>
                                        </a>

                                        <a href="#" class="red">
                                            <i class="ace-icon fa fa-times bigger-125"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="profile-activity clearfix">
                                    <div>
                                        <i class="pull-left thumbicon fa fa-picture-o btn-info no-hover"></i>
                                        <a class="user" href="#"> Alex Doe </a>
                                        uploaded a new photo.
                                        <a href="#">Take a look</a>

                                        <div class="time">
                                            <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                            5 hours ago
                                        </div>
                                    </div>

                                    <div class="tools action-buttons">
                                        <a href="#" class="blue">
                                            <i class="ace-icon fa fa-pencil bigger-125"></i>
                                        </a>

                                        <a href="#" class="red">
                                            <i class="ace-icon fa fa-times bigger-125"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="profile-activity clearfix">
                                    <div>
                                        <img class="pull-left" alt="David Palms's avatar" src="assets/images/avatars/avatar4.png" />
                                        <a class="user" href="#"> David Palms </a>

                                        left a comment on Alex's wall.
                                        <div class="time">
                                            <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                            8 hours ago
                                        </div>
                                    </div>

                                    <div class="tools action-buttons">
                                        <a href="#" class="blue">
                                            <i class="ace-icon fa fa-pencil bigger-125"></i>
                                        </a>

                                        <a href="#" class="red">
                                            <i class="ace-icon fa fa-times bigger-125"></i>
                                        </a>
                                    </div>
                                </div>
                            </div><!-- /.col -->

                            <!--<div class="col-sm-6">
                                <div class="profile-activity clearfix">
                                    <div>
                                        <i class="pull-left thumbicon fa fa-pencil-square-o btn-pink no-hover"></i>
                                        <a class="user" href="#"> Alex Doe </a>
                                        published a new blog post.
                                        <a href="#">Read now</a>

                                        <div class="time">
                                            <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                            11 hours ago
                                        </div>
                                    </div>

                                    <div class="tools action-buttons">
                                        <a href="#" class="blue">
                                            <i class="ace-icon fa fa-pencil bigger-125"></i>
                                        </a>

                                        <a href="#" class="red">
                                            <i class="ace-icon fa fa-times bigger-125"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="profile-activity clearfix">
                                    <div>
                                        <img class="pull-left" alt="Alex Doe's avatar" src="assets/images/avatars/avatar5.png" />
                                        <a class="user" href="#"> Alex Doe </a>

                                        upgraded his skills.
                                        <div class="time">
                                            <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                            12 hours ago
                                        </div>
                                    </div>

                                    <div class="tools action-buttons">
                                        <a href="#" class="blue">
                                            <i class="ace-icon fa fa-pencil bigger-125"></i>
                                        </a>

                                        <a href="#" class="red">
                                            <i class="ace-icon fa fa-times bigger-125"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="profile-activity clearfix">
                                    <div>
                                        <i class="pull-left thumbicon fa fa-key btn-info no-hover"></i>
                                        <a class="user" href="#"> Alex Doe </a>

                                        logged in.
                                        <div class="time">
                                            <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                            12 hours ago
                                        </div>
                                    </div>

                                    <div class="tools action-buttons">
                                        <a href="#" class="blue">
                                            <i class="ace-icon fa fa-pencil bigger-125"></i>
                                        </a>

                                        <a href="#" class="red">
                                            <i class="ace-icon fa fa-times bigger-125"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="profile-activity clearfix">
                                    <div>
                                        <i class="pull-left thumbicon fa fa-power-off btn-inverse no-hover"></i>
                                        <a class="user" href="#"> Alex Doe </a>

                                        logged out.
                                        <div class="time">
                                            <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                            16 hours ago
                                        </div>
                                    </div>

                                    <div class="tools action-buttons">
                                        <a href="#" class="blue">
                                            <i class="ace-icon fa fa-pencil bigger-125"></i>
                                        </a>

                                        <a href="#" class="red">
                                            <i class="ace-icon fa fa-times bigger-125"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="profile-activity clearfix">
                                    <div>
                                        <i class="pull-left thumbicon fa fa-key btn-info no-hover"></i>
                                        <a class="user" href="#"> {{--$etudiant[0]->nom_prenom--}} </a>

                                        logged in.
                                        <div class="time">
                                            <i class="ace-icon fa fa-clock-o bigger-110"></i>
                                            16 hours ago
                                        </div>
                                    </div>

                                    <div class="tools action-buttons">
                                        <a href="#" class="blue">
                                            <i class="ace-icon fa fa-pencil bigger-125"></i>
                                        </a>

                                        <a href="#" class="red">
                                            <i class="ace-icon fa fa-times bigger-125"></i>
                                        </a>
                                    </div>
                                </div>-->
                           <!-- </div><!-- /.col -->
                      <!--  </div><!-- /.row -->

                       <!-- <div class="space-12"></div>

                        <div class="center">
                            <button type="button" class="btn btn-sm btn-primary btn-white btn-round">
                                <i class="ace-icon fa fa-rss bigger-150 middle orange2"></i>
                                <span class="bigger-110">View more activities</span>

                                <i class="icon-on-right ace-icon fa fa-arrow-right"></i>
                            </button>
                        </div>-->
                                <div class="col-xs-12 col-sm-3 center">
                                                        <span class="profile-picture">
																<!--<img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="{{--asset('assets/images/avatars/profile-pic.jpg')--}}" />-->
                                                                                <?php $path=$etudiant[0]->photo_etudiant;?>

                                                                                <?php if($path==null){?>
                                                                                <img  class="editable img-responsive" style="width: 180px;height: 200px;"  alt="Alex's Avatar" id="ava" src="{{asset('assets/images/avatars/profile-pic.jpg')}}" />
                                                                                <?php } if($path!=null){?>
                                                                                <img class="editable img-responsive" alt="Alex's Avatar" id="ava" src="{{asset($path)}}" />
                                                                                <?php }?>
															</span>

                                    <div class="space space-4">

                                    </div>
                                    </div>
                              <div class="col-xs-12 col-sm-9">
                                  <div class="profile-user-info">
                                      <div class="profile-info-row">
                                          <div class="profile-info-name">  @lang('profil.lycee') </div>

                                          <div class="profile-info-value">
                                              <input type="text" class="form-control" name="lycee" value="{{$etudiant[0]->lycee_obtention_baccalaureat}}" />
                                          </div>
                                      </div>
                                  </div>


                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">  @lang('profil.seriebac') </div>

                                        <div class="profile-info-value">
                                            <?php $selectedvalue=$seriebac[0]->libelle_baccalaureat_fr ;?>

                                            <select name="seriebac" class="form-control">
                                                @foreach($seriebacs as $bacs)
                                                    <option value="{{$bacs->code_serie_baccalaureat_opi}}" {{ $selectedvalue == $bacs->libelle_baccalaureat_fr ? 'selected="selected"' : '' }}> {{$bacs->libelle_baccalaureat_fr}}</option>

                                                    <!-- <option value="2" selected="selected">2</option>-->
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">  @lang('profil.anneebac')  </div>

                                        <div class="profile-info-value">
                                            <input type="text" class="form-control" name="annebac" value="{{$etudiant[0]->annee_baccalaureat}}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">  @lang('profil.mentionbac')</div>

                                        <div class="profile-info-value">
                                            <input type="text" class="form-control" name="mentionbac" value="{{$etudiant[0]->mention_baccalaureat}}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-user-info">
                                    <div class="profile-info-row">
                                        <div class="profile-info-name">  @lang('profil.moyennebac') </div>

                                        <div class="profile-info-value">
                                            <input type="text" class="form-control" name="moyennebac" value=" {{$etudiant[0]->moyenne_baccalaureat}}" />
                                        </div>
                                    </div>
                                </div>
                                  <div>
                                      <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                  </div>
                                <!------------------>
                                </div>
                              <div class="hr hr10 hr-double"></div>
                            </div>
                    </div><!-- /#feed -->


                  <div id="parent" class="tab-pane ">
                      {{csrf_field()}}
                      <div class="row">


                                    <div class="col-xs-12 col-sm-3 center">
                                                            <span class="profile-picture">
																<!--<img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="{{--asset('assets/images/avatars/profile-pic.jpg')--}}" />-->
                                                                                <?php $path=$etudiant[0]->photo_etudiant;?>

                                                                                <?php if($path==null){?>
                                                                                <img  class="editable img-responsive" style="width: 180px;height: 200px;"  alt="Alex's Avatar" id="ava" src="{{asset('assets/images/avatars/profile-pic.jpg')}}" />
                                                                                <?php } if($path!=null){?>
                                                                                <img class="editable img-responsive" alt="Alex's Avatar" id="ava" src="{{asset($path)}}" />
                                                                                <?php }?>
															</span>

                                        <div class="space space-4">

                                        </div>
                                    </div>
                          <div class="col-xs-12 col-sm-9">
                                        <div class="profile-user-info">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name">  @lang('profil.nom_pere')</div>

                                                <div class="profile-info-value">
                                                    <input type="text" class="form-control" name="nom_pere" value=" {{$etudiant[0]->nom_pere_etudiant}}"/>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="profile-user-info">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name">  @lang('profil.prenom_pere') </div>

                                                <div class="profile-info-value">
                                                    <input type="text" class="form-control" name="prenom_pere" value=" {{$etudiant[0]->prenom_pere_etudiant}}"/>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="profile-user-info">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name">  @lang('profil.cni_pere')</div>

                                                <div class="profile-info-value">
                                                    <input type="text" class="form-control" name="cni_pere" value=" {{$etudiant[0]->cni_pere_etudiant}}"/>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="profile-user-info">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name">  @lang('profil.nom_mere')  </div>

                                                <div class="profile-info-value">
                                                    <input type="text" class="form-control" name="nom_mere" value=" {{$etudiant[0]->nom_mere_etudiant}}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile-user-info">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name">  @lang('profil.prenom_mere') </div>

                                                <div class="profile-info-value">
                                                    <input type="text" class="form-control" name="prenom_mere" value=" {{$etudiant[0]->prenom_mere_etudiant}}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile-user-info">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name">  @lang('profil.cni_mere') </div>

                                                <div class="profile-info-value">
                                                    <input type="text" class="form-control" name="cni_mere" value=" {{$etudiant[0]->cni_mere_etudiant}}}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile-user-info">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name">  @lang('profil.villeparent') </div>

                                                <div class="profile-info-value">
                                                    <input type="text" class="form-control" name="villeparent" value=" {{$etudiant[0]->ville_parents}}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="profile-user-info">
                                            <div class="profile-info-row">
                                                <div class="profile-info-name">  @lang('profil.adresseparent') </div>

                                                <div class="profile-info-value">
                                                    <input type="text" class="form-control" name="adressparent" value=" {{$etudiant[0]->adresse_parents_etud}}"/>
                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                        </div>



                          </div>
                          <div class="hr hr10 hr-double"></div>
                          </div>
                    </div><!-- /#friends -->

                  <div id="autre" class="tab-pane ">
                      {{csrf_field()}}
                      <div class="row">

                          <div class="col-xs-12 col-sm-3 center">
                                                            <span class="profile-picture">
																<!--<img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="{{--asset('assets/images/avatars/profile-pic.jpg')--}}" />-->
                                                                                <?php $path=$etudiant[0]->photo_etudiant;?>

                                                                                <?php if($path==null){?>
                                                                                <img  class="editable img-responsive" style="width: 180px;height: 200px;"  alt="Alex's Avatar" id="ava" src="{{asset('assets/images/avatars/profile-pic.jpg')}}" />
                                                                                <?php } if($path!=null){?>
                                                                                <img class="editable img-responsive" alt="Alex's Avatar" id="ava" src="{{asset($path)}}" />
                                                                                <?php }?>
															</span>

                              <div class="space space-4">

                              </div>
                          </div>
                         <div class="col-xs-12 col-sm-9">
                              <div class="profile-user-info">
                                  <div class="profile-info-row">
                                      <div class="profile-info-name">  Etablissement</div>

                                      <div class="profile-info-value">
                                          <?php $selectedvalue=$etablissement[0]->libelle_etablissement_fr ;?>
                                          <select name="etablissement" class="form-control">
                                              @foreach($etablissements as $etabs)
                                                  <option value="{{$etabs->code_etablissement_stat}}" {{ $selectedvalue == $etabs->libelle_etablissement_fr ? 'selected="selected"' : '' }}> {{$etabs->libelle_etablissement_fr}}</option>

                                                  <!-- <option value="2" selected="selected">2</option>-->
                                                @endforeach
                                          </select>                                      </div>
                                  </div>
                              </div>
                          <div class="col-xs-12 col-sm-9">
                              <div class="profile-user-info">
                                  <div class="profile-info-row">
                                      <div class="profile-info-name">  @lang('profil.choix_academie') </div>

                                      <div class="profile-info-value">
                                          <?php $selectedvalue=$academie[0]->libelle_academie_fr;?>
                                          <select name="academie" class="form-control">
                                              @foreach($academies as $academiess)
                                                  <option value="{{$academiess->code_academie}}" {{ $selectedvalue == $academiess->libelle_academie_fr ? 'selected="selected"' : '' }}> {{$academiess->libelle_academie_fr}}</option>

                                                  <!-- <option value="2" selected="selected">2</option>-->
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="profile-user-info">
                                  <div class="profile-info-row">
                                      <div class="profile-info-name">  @lang('profil.choix_province') </div>

                                      <div class="profile-info-value">
                                          <?php $selectedvalue = $province[0]->libelle_province_fr;?>
                                          <select name="province" class="form-control">
                                              @foreach($provinces as $provincess)
                                                  <option value="{{$provincess->code_province_opi}}" {{ $selectedvalue == $provincess->libelle_province_fr ? 'selected="selected"' : '' }}> {{$provincess->libelle_province_fr}}</option>

                                                  <!-- <option value="2" selected="selected">2</option>-->
                                              @endforeach
                                          </select>

                                      </div>
                                  </div>
                              </div>
                              <div class="profile-user-info">
                                  <div class="profile-info-row">
                                      <div class="profile-info-name">  diplome</div>

                                      <div class="profile-info-value">
                                          <?php $selectedvalue=$diplome[0]->libelle_diplome_fr ;?>
                                          <select name="diplome" class="form-control">
                                              @foreach($diplomes as $diplomess)

                                                  <option value="{{$diplomess->code_diplome}}" {{$selectedvalue == $diplomess->libelle_diplome_fr ? 'selected="selected"' : '' }}> {{$diplomess->libelle_diplome_fr}}</option>

                                                  <!-- <option value="2" selected="selected">2</option>-->
                                            @endforeach
                                          </select>
                                      </div>
                                  </div>
                              </div>
                              <div class="profile-user-info">
                                  <div class="profile-info-row">
                                      <div class="profile-info-name">  @lang('profil.choix_fil') </div>

                                      <div class="profile-info-value">
                                          <?php $selectedvalue=$filiere[0]->libelle_filiere;?>
                                          <select name="filiere" class="form-control">
                                              @foreach($filieres as $filieress)
                                                  <option value="{{$filieress->code_filiere_stat}}" {{ $selectedvalue == $filieress->libelle_filiere ? 'selected="selected"' : '' }}> {{$filieress->libelle_filiere}}</option>

                                                  <!-- <option value="2" selected="selected">2</option>-->
                                              @endforeach
                                          </select>
                                      </div>
                                  </div>
                              </div>

                              <div class="profile-user-info">
                                  <div class="profile-info-row">
                                      <div class="profile-info-name">  @lang('profil.num_dossier') </div>

                                      <div class="profile-info-value">
                                          <input type="text" class="form-control" name="num_dossier" value=" {{$etudiant[0]->numero_dossier_inscription}}"/>
                                      </div>
                                  </div>
                              </div>
                              <div class="profile-user-info">
                                  <div class="profile-info-row">
                                      <div class="profile-info-name">  @lang('profil.date_inscription') </div>

                                      <div class="profile-info-value">
                                          <input type="text" class="form-control" name="date_inscription" value=" {{$etudiant[0]->date_inscription_etud}}"/>
                                      </div>
                                  </div>
                              </div>
                              <div class="profile-user-info">
                                  <div class="profile-info-row">
                                      <div class="profile-info-name">  @lang('profil.heure_inscription')</div>

                                      <div class="profile-info-value">
                                          <input type="text" class="form-control" name="heure_inscription" value=" {{$etudiant[0]->heure_inscription_etud}}"/>
                                      </div>
                                  </div>
                              </div>
                              <div>
                                  <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                              </div>

                  </div>
                          <div class="hr hr10 hr-double"></div>
                          </div>
              </div>

</div>
                </form>
            </div>
    </div>
    </div>



        <script src="{{asset('assets/js/jquery-2.1.4.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap-editable.min.js')}}"></script>



        <script src="{{asset('assets/js/jquery-ui.custom.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.ui.touch-punch.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.gritter.min.js')}}"></script>
        <script src="{{asset('assets/js/bootbox.js')}}"></script>
        <script src="{{asset('assets/js/jquery.easypiechart.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap-datepicker.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.hotkeys.index.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap-wysiwyg.min.js')}}"></script>
        <script src="{{asset('assets/js/select2.min.js')}}"></script>
        <script src="{{asset('assets/js/spinbox.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap-editable.min.js')}}"></script>
        <script src="{{asset('assets/js/ace-editable.min.js')}}"></script>
        <script src="{{asset('assets/js/jquery.maskedinput.min.js')}}"></script>

        <!-- ace scripts -->
        <script src="{{asset('assets/js/ace-elements.min.js')}}"></script>
        <script src="{{asset('assets/js/ace.min.js')}}"></script>
        <!-- <![endif]-->

        <!--[if IE]>

        <![endif]-->
        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

        <!-- page specific plugin scripts -->

        <!--[if lte IE 8]>

        <![endif]-->








        <!-- inline scripts related to this page -->
        <script type="text/javascript">
            jQuery(function($) {

                //editables on first profile page
                $.fn.editable.defaults.mode = 'inline';
                $.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
                $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';

                //editables

                //text editable
                $('#username')
                        .editable({
                            type: 'text',
                            name: 'username'
                        });



                //select2 editable
                var countries = [];
                $.each({ "CA": "Canada", "IN": "India", "NL": "Netherlands", "TR": "Turkey", "US": "United States"}, function(k, v) {
                    countries.push({id: k, text: v});
                });

                var cities = [];
                cities["CA"] = [];
                $.each(["Toronto", "Ottawa", "Calgary", "Vancouver"] , function(k, v){
                    cities["CA"].push({id: v, text: v});
                });
                cities["IN"] = [];
                $.each(["Delhi", "Mumbai", "Bangalore"] , function(k, v){
                    cities["IN"].push({id: v, text: v});
                });
                cities["NL"] = [];
                $.each(["Amsterdam", "Rotterdam", "The Hague"] , function(k, v){
                    cities["NL"].push({id: v, text: v});
                });
                cities["TR"] = [];
                $.each(["Ankara", "Istanbul", "Izmir"] , function(k, v){
                    cities["TR"].push({id: v, text: v});
                });
                cities["US"] = [];
                $.each(["New York", "Miami", "Los Angeles", "Chicago", "Wysconsin"] , function(k, v){
                    cities["US"].push({id: v, text: v});
                });

                var currentValue = "NL";
                $('#country').editable({
                    type: 'select2',
                    value : 'NL',
                    //onblur:'ignore',
                    source: countries,
                    select2: {
                        'width': 140
                    },
                    success: function(response, newValue) {
                        if(currentValue == newValue) return;
                        currentValue = newValue;

                        var new_source = (!newValue || newValue == "") ? [] : cities[newValue];

                        //the destroy method is causing errors in x-editable v1.4.6+
                        //it worked fine in v1.4.5
                        /**
                         $('#city').editable('destroy').editable({
							type: 'select2',
							source: new_source
						}).editable('setValue', null);
                         */

                        //so we remove it altogether and create a new element
                        var city = $('#city').removeAttr('id').get(0);
                        $(city).clone().attr('id', 'city').text('Select City').editable({
                            type: 'select2',
                            value : null,
                            //onblur:'ignore',
                            source: new_source,
                            select2: {
                                'width': 140
                            }
                        }).insertAfter(city);//insert it after previous instance
                        $(city).remove();//remove previous instance

                    }
                });

                $('#city').editable({
                    type: 'select2',
                    value : 'Amsterdam',
                    //onblur:'ignore',
                    source: cities[currentValue],
                    select2: {
                        'width': 140
                    }
                });



                //custom date editable
                $('#signup').editable({
                    type: 'adate',
                    date: {
                        //datepicker plugin options
                        format: 'yyyy/mm/dd',
                        viewformat: 'yyyy/mm/dd',
                        weekStart: 1

                        //,nativeUI: true//if true and browser support input[type=date], native browser control will be used
                        //,format: 'yyyy-mm-dd',
                        //viewformat: 'yyyy-mm-dd'
                    }
                })

                $('#age').editable({
                    type: 'spinner',
                    name : 'age',
                    spinner : {
                        min : 16,
                        max : 99,
                        step: 1,
                        on_sides: true
                        //,nativeUI: true//if true and browser support input[type=number], native browser control will be used
                    }
                });


                $('#login').editable({
                    type: 'slider',
                    name : 'login',

                    slider : {
                        min : 1,
                        max: 50,
                        width: 100
                        //,nativeUI: true//if true and browser support input[type=range], native browser control will be used
                    },
                    success: function(response, newValue) {
                        if(parseInt(newValue) == 1)
                            $(this).html(newValue + " hour ago");
                        else $(this).html(newValue + " hours ago");
                    }
                });

                $('#about').editable({
                    mode: 'inline',
                    type: 'wysiwyg',
                    name : 'about',

                    wysiwyg : {
                        //css : {'max-width':'300px'}
                    },
                    success: function(response, newValue) {
                    }
                });



                // *** editable avatar *** //
                try {//ie8 throws some harmless exceptions, so let's catch'em

                    //first let's add a fake appendChild method for Image element for browsers that have a problem with this
                    //because editable plugin calls appendChild, and it causes errors on IE at unpredicted points
                    try {
                        document.createElement('IMG').appendChild(document.createElement('B'));
                    } catch(e) {
                        Image.prototype.appendChild = function(el){}
                    }

                    var last_gritter
                    $('#avatar').editable({
                        type: 'image',
                        name: 'avatar',
                        value: null,
                        //onblur: 'ignore',  //don't reset or hide editable onblur?!
                        image: {
                            //specify ace file input plugin's options here
                            btn_choose: 'Change Avatar',
                            droppable: true,
                            maxSize: 110000,//~100Kb

                            //and a few extra ones here
                            name: 'avatar',//put the field name here as well, will be used inside the custom plugin
                            on_error : function(error_type) {//on_error function will be called when the selected file has a problem
                                if(last_gritter) $.gritter.remove(last_gritter);
                                if(error_type == 1) {//file format error
                                    last_gritter = $.gritter.add({
                                        title: 'File is not an image!',
                                        text: 'Please choose a jpg|gif|png image!',
                                        class_name: 'gritter-error gritter-center'
                                    });
                                } else if(error_type == 2) {//file size rror
                                    last_gritter = $.gritter.add({
                                        title: 'File too big!',
                                        text: 'Image size should not exceed 100Kb!',
                                        class_name: 'gritter-error gritter-center'
                                    });
                                }
                                else {//other error
                                }
                            },
                            on_success : function() {
                                $.gritter.removeAll();
                            }
                        },
                        url: function(params) {
                            // ***UPDATE AVATAR HERE*** //
                            //for a working upload example you can replace the contents of this function with
                            //examples/profile-avatar-update.js

                            var deferred = new $.Deferred

                            var value = $('#avatar').next().find('input[type=hidden]:eq(0)').val();
                            if(!value || value.length == 0) {
                                deferred.resolve();
                                return deferred.promise();
                            }


                            //dummy upload
                            setTimeout(function(){
                                if("FileReader" in window) {
                                    //for browsers that have a thumbnail of selected image
                                    var thumb = $('#avatar').next().find('img').data('thumb');
                                    if(thumb) $('#avatar').get(0).src = thumb;
                                }

                                deferred.resolve({'status':'OK'});

                                if(last_gritter) $.gritter.remove(last_gritter);
                                last_gritter = $.gritter.add({
                                    title: 'Avatar Updated!',
                                    text: 'Uploading to server can be easily implemented. A working example is included with the template.',
                                    class_name: 'gritter-info gritter-center'
                                });

                            } , parseInt(Math.random() * 800 + 800))

                            return deferred.promise();

                            // ***END OF UPDATE AVATAR HERE*** //
                        },

                        success: function(response, newValue) {
                        }
                    })
                }catch(e) {}

                /**
                 //let's display edit mode by default?
                 var blank_image = true;//somehow you determine if image is initially blank or not, or you just want to display file input at first
                 if(blank_image) {
					$('#avatar').editable('show').on('hidden', function(e, reason) {
						if(reason == 'onblur') {
							$('#avatar').editable('show');
							return;
						}
						$('#avatar').off('hidden');
					})
				}
                 */

                    //another option is using modals
                $('#avatar2').on('click', function(){
                    var modal =
                            '<div class="modal fade">\
                              <div class="modal-dialog">\
                               <div class="modal-content">\
                                <div class="modal-header">\
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>\
                                    <h4 class="blue">Change Avatar</h4>\
                                     <td width="40%" align="right"></td>\
                                   <td width="30"><span class="text-muted">jpg, png, gif</span></td>\
                                 <td width="30%" align="left"></td>\
                                </div>\
                                \
                                 @if (count($errors) > 0)\
                                <div class="alert alert-danger">Upload Validation Error<br><br>\
                    <ul>\
                    @foreach ($errors->all() as $error)\
                    <li>{{ $error }}</li>\
                    @endforeach\
                </ul>\
                    </div>\
                    @endif\
                    @if ($message = Session::get('success'))\
                    <div class="alert alert-success alert-block">\
                    <button type="button" class="close" data-dismiss="alert">×</button>\
                    <strong>{{ $message }}</strong>\
                    </div>\
                    @endif\
                    <form method="post" class="no-margin" action="{{url('/upload')}}" enctype="multipart/form-data" id="up_fr" >\
                                {{ csrf_field() }}\
                                 <div class="modal-body">\
                                    <div class="space-4"></div>\
                                    <div style="width:75%;margin-left:12%;">\
                                    <input type="file" name="image_profile" id="image_profile" /></div>\
                                 </div>\
                                \
                                 <div class="modal-footer center">\
                                    <button type="submit" class="btn btn-sm btn-success"><i class="ace-icon fa fa-check"></i> modifier</button>\
                                    <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Cancel</button>\
                                 </div>\
                                </form>\
                              </div>\
                             </div>\
                            </div>\
                            ';

                    $(function() {
                        //hang on event of form with id=myform
                        $("#up_fr").submit(function(e) {

                            //prevent Default functionality
                            e.preventDefault();

                            //get the action-url of the form
                            var actionurl = e.currentTarget.action;

                            //do your own request an handle the results
                            $.ajax({
                                url: '{{url('/upload')}}',
                                type: 'post',
                                dataType: 'application/json',
                                data: $("#up_fr").serialize(),
                                success: function(data) {

                                }
                            });

                        });

                    });
                    var modal = $(modal);
                    modal.modal("show").on("hidden", function(){
                        modal.remove();
                    });

                    var working = false;

                    var form = modal.find('form:eq(0)');
                    var file = form.find('input[type=file]').eq(0);
                    file.ace_file_input({
                        style:'well',
                        btn_choose:'Click to choose new avatar',
                        btn_change:null,
                        no_icon:'ace-icon fa fa-picture-o',
                        thumbnail:'small',
                        before_remove: function() {
                            //don't remove/reset files while being uploaded
                            return !working;
                        },
                        allowExt: ['jpg', 'jpeg', 'png', 'gif'],
                        allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
                    });

                    form.on('submit', function(){
                        if(!file.data('ace_input_files')) return false;
                        file.ace_file_input('disable');
                        form.find('button').attr('disabled', 'disabled');

                        form.find('.modal-body').append("<div class='center'><i class='ace-icon fa fa-spinner fa-spin bigger-150 orange'></i></div>");

                        var deferred = new $.Deferred;
                        working = true;
                        deferred.done(function() {

                            form.find('button').removeAttr('disabled');

                            form.find('input[type=file]').ace_file_input('enable');
                            form.find('.modal-body > :last-child').remove();


                            modal.modal("hide");


                            var thumb = file.next().find('img').data('thumb');
                            if(thumb) $('#avatar2').get(0).src = thumb;

                            working = false;
                        });


                        setTimeout(function(){
                            deferred.resolve();

                        } , parseInt(Math.random() * 800 + 800));

                        return false;
                    });

                });



                //////////////////////////////
                $('#profile-feed-1').ace_scroll({
                    height: '250px',
                    mouseWheelLock: true,
                    alwaysVisible : true
                });

                $('a[ data-original-title]').tooltip();

                $('.easy-pie-chart.percentage').each(function(){
                    var barColor = $(this).data('color') || '#555';
                    var trackColor = '#E2E2E2';
                    var size = parseInt($(this).data('size')) || 72;
                    $(this).easyPieChart({
                        barColor: barColor,
                        trackColor: trackColor,
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: parseInt(size/10),
                        animate:false,
                        size: size
                    }).css('color', barColor);
                });
                //////////
                $('#id-input-file-1 , #id-input-file-2').ace_file_input({
                    no_file:'No File ...',
                    btn_choose:'Choose',
                    btn_change:'Change',
                    droppable:false,
                    onchange:null,
                    thumbnail:false //| true | large
                    // whitelist:'gif|png|jpg|jpeg'
                    //blacklist:'exe|php'
                    //onchange:''
                    //

                });
                ///////////////////////////////////////////

                //right & left position
                //show the user info on right or left depending on its position
                $('#user-profile-2 .memberdiv').on('mouseenter touchstart', function(){
                    var $this = $(this);
                    var $parent = $this.closest('.tab-pane');

                    var off1 = $parent.offset();
                    var w1 = $parent.width();

                    var off2 = $this.offset();
                    var w2 = $this.width();

                    var place = 'left';
                    if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) place = 'right';

                    $this.find('.popover').removeClass('right left').addClass(place);
                }).on('click', function(e) {
                    e.preventDefault();
                });


                ///////////////////////////////////////////
                $('#user-profile-3')
                        .find('input[type=file]').ace_file_input({
                            style:'well',
                            btn_choose:'Change avatar',
                            btn_change:null,
                            no_icon:'ace-icon fa fa-picture-o',
                            thumbnail:'large',
                            droppable:true,

                            allowExt: ['jpg', 'jpeg', 'png', 'gif'],
                            allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
                        })
                        .end().find('button[type=reset]').on(ace.click_event, function(){
                            $('#user-profile-3 input[type=file]').ace_file_input('reset_input');
                        })
                        .end().find('.date-picker').datepicker().next().on(ace.click_event, function(){
                            $(this).prev().focus();
                        })
                $('.input-mask-phone').mask('(999) 999-9999');

                $('#user-profile-3').find('input[type=file]').ace_file_input('show_file_list', [{type: 'image', name: $('#avatar').attr('src')}]);


                ////////////////////
                //change profile
                $('[data-toggle="buttons"] .btn').on('click', function(e){
                    var target = $(this).find('input[type=radio]');
                    var which = parseInt(target.val());
                    $('.user-profile').parent().addClass('hide');
                    $('#user-profile-'+which).parent().removeClass('hide');
                });



                /////////////////////////////////////
                $(document).one('ajaxloadstart.page', function(e) {
                    //in ajax mode, remove remaining elements before leaving page
                    try {
                        $('.editable').editable('destroy');
                    } catch(e) {}
                    $('[class*=select2]').remove();
                });
            });
        </script>
        </body>
        </html>

    @endsection