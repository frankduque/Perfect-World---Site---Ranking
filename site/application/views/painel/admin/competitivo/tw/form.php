<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
</div>
<div class="container-fluid mt--7">
  <div class="row">
    <div class="col-xl-12">
      <div class="card shadow">
        <div class="card-header bg-transparent">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="text-uppercase text-muted ls-1 mb-1">Tw</h6>
              <h2 class="mb-0">Editar Update</h2>
            </div>
          </div>
        </div>
        <div class="card-body">
            <?php if (validation_errors() != false): ?>
              <div class="alert alert-danger" role="alert">
                <strong>Erro!</strong>
                <?= validation_errors() ?>
              </div>
          <?php endif; ?>
          <form id="Form" method="post" action="<?php echo base_url("admin/tw/salvar/") . $update->id ?>">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">

            <div class="row">
              <div class="col-8 offset-2 mt-3">
                <div class="form-group focused">
                  <label class="form-control-label" for="periodicidade">Periodicidade</label>
                  <select id="common_options" onchange="select_common_option()" class="form-control form-control-alternative">
                    <option <?php echo ($update->periodicidade == "--" ? "selected" : null) ?> value="--"> -- Configurações comuns -- </option>
                    <option <?php echo ($update->periodicidade == "* * * * *" ? "selected" : null) ?> value="* * * * *">Uma vez por minuto(* * * * *)</option>
                    <option <?php echo ($update->periodicidade == "*/5 * * * *" ? "selected" : null) ?> value="*/5 * * * *">Uma vez a cada cinco minutos(*/5 * * * *)</option>
                    <option <?php echo ($update->periodicidade == "*/10 * * * *" ? "selected" : null) ?> value="*/10 * * * *">Uma vez a cada cinco minutos(*/10 * * * *)</option>
                    <option <?php echo ($update->periodicidade == "*/15 * * * *" ? "selected" : null) ?> value="*/15 * * * *">Uma vez a cada cinco minutos(*/15 * * * *)</option>
                    <option <?php echo ($update->periodicidade == "0,30 * * * *" ? "selected" : null) ?> value="0,30 * * * *">Duas vezes por hora(0,30 * * * *)</option>
                    <option <?php echo ($update->periodicidade == "0 * * * *" ? "selected" : null) ?> value="0 * * * *">Uma vez por hora(0 * * * *)</option>
                    <option <?php echo ($update->periodicidade == "0 0,12 * * *" ? "selected" : null) ?> value="0 0,12 * * *">Duas vezes por dia(0 0,12 * * *)</option>
                    <option <?php echo ($update->periodicidade == "0 0 * * *" ? "selected" : null) ?> value="0 0 * * *">Uma vez por dia(0 0 * * *)</option>
                    <option <?php echo ($update->periodicidade == "0 0 * * 0" ? "selected" : null) ?> value="0 0 * * 0">Uma vez por semana(0 0 * * 0)</option>
                    <option <?php echo ($update->periodicidade == "0 0 1,15 * *" ? "selected" : null) ?> value="0 0 1,15 * *">No 1º e no 15º dia do mês(0 0 1,15 * *)</option>
                    <option <?php echo ($update->periodicidade == "0 0 1 * *" ? "selected" : null) ?> value="0 0 1 * *">Uma vez por mês(0 0 1 * *)</option>
                    <option <?php echo ($update->periodicidade == "0 0 1 1 *" ? "selected" : null) ?> value="0 0 1 1 *">Uma vez por ano(0 0 1 1 *)</option>
                  </select>
                </div>

                <div class="row">
                  <div class="col-4">
                    <div class="form-group focused">
                      <label class="form-control-label" for="minutos">Minutos</label>
                      <input required type="text" data-parsley-pattern="/^(\*|[1-5]?[0-9](-[1-5]?[0-9])?)(\/[1-9][0-9]*)?(,(\*|[1-5]?[0-9](-[1-5]?[0-9])?)(\/[1-9][0-9]*)?)*$/" value="<?php echo $minutos; ?>" name="minutos" id="minutos" class="form-control form-control-alternative">
                    </div>
                  </div>
                  <div class="col-8">
                    <div class="form-group focused">
                      <label class="form-control-label" for="canalmensagem">&nbsp;</label>
                      <select id="select_minutos" class="form-control form-control-alternative" onchange="select_single_option('minutos')">
                        <option <?php echo ($minutos == "--" ? "selected" : null) ?> value="--">-- Configurações comuns --</option>
                        <option <?php echo ($minutos == "*" ? "selected" : null) ?> value="*">Uma vez por minuto(*)</option>
                        <option <?php echo ($minutos == "*/2" ? "selected" : null) ?> value="*/2">Uma vez a cada dois minutos(*/2)</option>
                        <option <?php echo ($minutos == "*/5" ? "selected" : null) ?> value="*/5">Uma vez a cada cinco minutos(*/5)</option>
                        <option <?php echo ($minutos == "*/10" ? "selected" : null) ?> value="*/10">Uma vez a cada dez minutos(*/10)</option>
                        <option <?php echo ($minutos == "*/15" ? "selected" : null) ?> value="*/15">Uma vez a cada quinze minutos(*/15)</option>
                        <option <?php echo ($minutos == "0,30" ? "selected" : null) ?> value="0,30">Uma vez a cada trinta minutos(0,30)</option>
                        <option <?php echo ($minutos == "---" ? "selected" : null) ?> value="---">-- Minutos --</option>
                        <option <?php echo ($minutos == "0" ? "selected" : null) ?> value="0">:00 (Na hora cheia.) (0)</option>
                        <option <?php echo ($minutos == "1" ? "selected" : null) ?> value="1">:01 (1)</option>
                        <option <?php echo ($minutos == "2" ? "selected" : null) ?> value="2">:02 (2)</option>
                        <option <?php echo ($minutos == "3" ? "selected" : null) ?> value="3">:03 (3)</option>
                        <option <?php echo ($minutos == "4" ? "selected" : null) ?> value="4">:04 (4)</option>
                        <option <?php echo ($minutos == "5" ? "selected" : null) ?> value="5">:05 (5)</option>
                        <option <?php echo ($minutos == "6" ? "selected" : null) ?> value="6">:06 (6)</option>
                        <option <?php echo ($minutos == "7" ? "selected" : null) ?> value="7">:07 (7)</option>
                        <option <?php echo ($minutos == "8" ? "selected" : null) ?> value="8">:08 (8)</option>
                        <option <?php echo ($minutos == "9" ? "selected" : null) ?> value="9">:09 (9)</option>
                        <option <?php echo ($minutos == "10" ? "selected" : null) ?> value="10">:10 (10)</option>
                        <option <?php echo ($minutos == "11" ? "selected" : null) ?> value="11">:11 (11)</option>
                        <option <?php echo ($minutos == "12" ? "selected" : null) ?> value="12">:12 (12)</option>
                        <option <?php echo ($minutos == "13" ? "selected" : null) ?> value="13">:13 (13) </option>
                        <option <?php echo ($minutos == "14" ? "selected" : null) ?> value="14">:14 (14) </option>
                        <option <?php echo ($minutos == "15" ? "selected" : null) ?> value="15">:15 (Aos 15 minutos.) (15)   </option>
                        <option <?php echo ($minutos == "16" ? "selected" : null) ?> value="16">:16 (16)</option>
                        <option <?php echo ($minutos == "17" ? "selected" : null) ?> value="17">:17 (17)</option>
                        <option <?php echo ($minutos == "18" ? "selected" : null) ?> value="18">:18 (18)</option>                                                
                        <option <?php echo ($minutos == "19" ? "selected" : null) ?> value="19">:19 (19)</option>
                        <option <?php echo ($minutos == "20" ? "selected" : null) ?> value="20">:20 (20)</option>
                        <option <?php echo ($minutos == "21" ? "selected" : null) ?> value="21">:21 (21)</option>
                        <option <?php echo ($minutos == "22" ? "selected" : null) ?> value="22">:22 (22)</option>
                        <option <?php echo ($minutos == "23" ? "selected" : null) ?> value="23">:23 (23)</option>
                        <option <?php echo ($minutos == "24" ? "selected" : null) ?> value="24">:24 (24)</option>
                        <option <?php echo ($minutos == "25" ? "selected" : null) ?> value="25">:25 (25)</option>
                        <option <?php echo ($minutos == "26" ? "selected" : null) ?> value="26">:26 (26)</option>
                        <option <?php echo ($minutos == "27" ? "selected" : null) ?> value="27">:27 (27)</option>
                        <option <?php echo ($minutos == "28" ? "selected" : null) ?> value="28">:28 (28)</option>
                        <option <?php echo ($minutos == "29" ? "selected" : null) ?> value="29">:29 (29)</option>
                        <option <?php echo ($minutos == "30" ? "selected" : null) ?> value="30">:30 (Aos 30 minutos.) (30)</option>
                        <option <?php echo ($minutos == "31" ? "selected" : null) ?> value="31">:31 (31)</option>
                        <option <?php echo ($minutos == "32" ? "selected" : null) ?> value="32">:32 (32)</option>
                        <option <?php echo ($minutos == "33" ? "selected" : null) ?> value="33">:33 (33)</option>
                        <option <?php echo ($minutos == "34" ? "selected" : null) ?> value="34">:34 (34)</option>
                        <option <?php echo ($minutos == "35" ? "selected" : null) ?> value="35">:35 (35)</option>
                        <option <?php echo ($minutos == "36" ? "selected" : null) ?> value="36">:36 (36)</option>
                        <option <?php echo ($minutos == "37" ? "selected" : null) ?> value="37">:37 (37)</option>
                        <option <?php echo ($minutos == "38" ? "selected" : null) ?> value="38">:38 (38)</option>
                        <option <?php echo ($minutos == "39" ? "selected" : null) ?> value="39">:39 (39)</option>
                        <option <?php echo ($minutos == "40" ? "selected" : null) ?> value="40">:40 (40)</option>
                        <option <?php echo ($minutos == "41" ? "selected" : null) ?> value="41">:41 (41)</option>
                        <option <?php echo ($minutos == "42" ? "selected" : null) ?> value="42">:42 (42)</option>
                        <option <?php echo ($minutos == "43" ? "selected" : null) ?> value="43">:43 (43)</option>
                        <option <?php echo ($minutos == "44" ? "selected" : null) ?> value="44">:44 (44)</option>
                        <option <?php echo ($minutos == "45" ? "selected" : null) ?> value="45">:45 (Aos 45 minutos.) (45)</option>
                        <option <?php echo ($minutos == "46" ? "selected" : null) ?> value="46">:46 (46)</option>
                        <option <?php echo ($minutos == "47" ? "selected" : null) ?> value="47">:47 (47)</option>
                        <option <?php echo ($minutos == "48" ? "selected" : null) ?> value="48">:48 (48)</option>
                        <option <?php echo ($minutos == "49" ? "selected" : null) ?> value="49">:49 (49)</option>
                        <option <?php echo ($minutos == "50" ? "selected" : null) ?> value="50">:50 (50)</option>
                        <option <?php echo ($minutos == "51" ? "selected" : null) ?> value="51">:51 (51)</option>
                        <option <?php echo ($minutos == "52" ? "selected" : null) ?> value="52">:52 (52)</option>
                        <option <?php echo ($minutos == "53" ? "selected" : null) ?> value="53">:53 (53)</option>
                        <option <?php echo ($minutos == "54" ? "selected" : null) ?> value="54">:54 (54)</option>
                        <option <?php echo ($minutos == "55" ? "selected" : null) ?> value="55">:55 (55)</option>
                        <option <?php echo ($minutos == "56" ? "selected" : null) ?> value="56">:56 (56)</option>
                        <option <?php echo ($minutos == "57" ? "selected" : null) ?> value="57">:57 (57)</option>
                        <option <?php echo ($minutos == "58" ? "selected" : null) ?> value="58">:58 (58)</option>
                        <option <?php echo ($minutos == "59" ? "selected" : null) ?> value="59">:59 (59)</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-group focused">
                      <label class="form-control-label" for="horas">Horas</label>
                      <input required data-parsley-pattern="/^(\*|(1?[0-9]|2[0-3])(-(1?[0-9]|2[0-3]))?)(\/[1-9][0-9]*)?(,(\*|(1?[0-9]|2[0-3])(-(1?[0-9]|2[0-3]))?)(\/[1-9][0-9]*)?)*$/" type="text" value="<?php echo $horas; ?>" name="horas" id="horas" class="form-control form-control-alternative">
                    </div>
                  </div>
                  <div class="col-8">
                    <div class="form-group focused">
                      <label class="form-control-label" for="canalmensagem">&nbsp;</label>
                      <select id="select_horas" class="form-control form-control-alternative" onchange="select_single_option('horas')">
                        <option <?php echo ($horas == "--" ? "selected" : null) ?> value="--">-- Configurações comuns --</option>
                        <option <?php echo ($horas == "*" ? "selected" : null) ?> value="*">A cada hora (*)</option>
                        <option <?php echo ($horas == "*/2" ? "selected" : null) ?> value="*/2">A cada duas horas (*/2)</option>
                        <option <?php echo ($horas == "*/3" ? "selected" : null) ?> value="*/3">A cada três horas (*/3)</option>
                        <option <?php echo ($horas == "*/4" ? "selected" : null) ?> value="*/4">A cada quatro horas (*/4)</option>
                        <option <?php echo ($horas == "*/6" ? "selected" : null) ?> value="*/6">A cada seis horas (*/6)</option>
                        <option <?php echo ($horas == "0,12" ? "selected" : null) ?> value="0,12">A cada doze horas (0,12)</option>
                        <option <?php echo ($horas == "---" ? "selected" : null) ?> value="---">-- Horas --</option>
                        <option <?php echo ($horas == "0" ? "selected" : null) ?> value="0">12:00 a.m. Meia-noite (0)</option>
                        <option <?php echo ($horas == "1" ? "selected" : null) ?> value="1">1:00 a.m. (1)</option>
                        <option <?php echo ($horas == "2" ? "selected" : null) ?> value="2">2:00 a.m. (2)</option>
                        <option <?php echo ($horas == "3" ? "selected" : null) ?> value="3">3:00 a.m. (3)</option>
                        <option <?php echo ($horas == "4" ? "selected" : null) ?> value="4">4:00 a.m. (4)</option>
                        <option <?php echo ($horas == "5" ? "selected" : null) ?> value="5">5:00 a.m. (5)</option>
                        <option <?php echo ($horas == "6" ? "selected" : null) ?> value="6">6:00 a.m. (6)</option>
                        <option <?php echo ($horas == "7" ? "selected" : null) ?> value="7">7:00 a.m. (7)</option>
                        <option <?php echo ($horas == "8" ? "selected" : null) ?> value="8">8:00 a.m. (8)</option>
                        <option <?php echo ($horas == "9" ? "selected" : null) ?> value="9">9:00 a.m. (9)</option>
                        <option <?php echo ($horas == "10" ? "selected" : null) ?> value="10">10:00 a.m. (10)</option>
                        <option <?php echo ($horas == "11" ? "selected" : null) ?> value="11">11:00 a.m. (11)</option>
                        <option <?php echo ($horas == "12" ? "selected" : null) ?> value="12">12:00 p.m. Meio-dia (12)</option>
                        <option <?php echo ($horas == "13" ? "selected" : null) ?> value="13">1:00 p.m. (13)</option>
                        <option <?php echo ($horas == "14" ? "selected" : null) ?> value="14">2:00 p.m. (14)</option>
                        <option <?php echo ($horas == "15" ? "selected" : null) ?> value="15">3:00 p.m. (15)</option>
                        <option <?php echo ($horas == "16" ? "selected" : null) ?> value="16">4:00 p.m. (16)</option>
                        <option <?php echo ($horas == "17" ? "selected" : null) ?> value="17">5:00 p.m. (17)</option>
                        <option <?php echo ($horas == "18" ? "selected" : null) ?> value="18">6:00 p.m. (18)</option>
                        <option <?php echo ($horas == "19" ? "selected" : null) ?> value="19">7:00 p.m. (19)</option>
                        <option <?php echo ($horas == "20" ? "selected" : null) ?> value="20">8:00 p.m. (20)</option>
                        <option <?php echo ($horas == "21" ? "selected" : null) ?> value="21">9:00 p.m. (21)</option>
                        <option <?php echo ($horas == "22" ? "selected" : null) ?> value="22">10:00 p.m. (22)</option>
                        <option <?php echo ($horas == "23" ? "selected" : null) ?> value="23">11:00 p.m. (23)</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-group focused">
                      <label class="form-control-label" for="meses">Dias</label>
                      <input required type="text" data-parsley-pattern="/^(\*|([1-9]|[1-2][0-9]?|3[0-1])(-([1-9]|[1-2][0-9]?|3[0-1]))?)(\/[1-9][0-9]*)?(,(\*|([1-9]|[1-2][0-9]?|3[0-1])(-([1-9]|[1-2][0-9]?|3[0-1]))?)(\/[1-9][0-9]*)?)*$/" value="<?php echo $dias; ?>" name="dias" id="dias" class="form-control form-control-alternative">
                    </div>
                  </div>
                  <div class="col-8">
                    <div class="form-group focused">
                      <label class="form-control-label" for="canalmensagem">&nbsp;</label>
                      <select id="select_dias" onchange="select_single_option('dias')" class="form-control form-control-alternative">
                        <option <?php echo ($dias == "--" ? "selected" : null) ?> value="--"> -- Configurações comuns -- </option>
                        <option <?php echo ($dias == "*" ? "selected" : null) ?> value="*">A cada dia (*)</option>
                        <option <?php echo ($dias == "" ? "selected" : null) ?> value="*/2">A cada dois dias (*/2)</option>
                        <option <?php echo ($dias == "1,15" ? "selected" : null) ?> value="1,15">No 1º e no 15º dia do mês (1,15)</option>
                        <option <?php echo ($dias == "---" ? "selected" : null) ?> value="---">-- Dias --</option>
                        <option <?php echo ($dias == "1" ? "selected" : null) ?> value="1">1º (1)</option>
                        <option <?php echo ($dias == "2" ? "selected" : null) ?> value="2">2º (2)</option>
                        <option <?php echo ($dias == "3" ? "selected" : null) ?> value="3">3º (3)</option>
                        <option <?php echo ($dias == "4" ? "selected" : null) ?> value="4">4º (4)</option>
                        <option <?php echo ($dias == "5" ? "selected" : null) ?> value="5">5º (5)</option>
                        <option <?php echo ($dias == "6" ? "selected" : null) ?> value="6">6º (6)</option>
                        <option <?php echo ($dias == "7" ? "selected" : null) ?> value="7">7º (7)</option>
                        <option <?php echo ($dias == "8" ? "selected" : null) ?> value="8">8º (8)</option>
                        <option <?php echo ($dias == "9" ? "selected" : null) ?> value="9">9º (9)</option>
                        <option <?php echo ($dias == "10" ? "selected" : null) ?> value="10">10º (10)</option>
                        <option <?php echo ($dias == "11" ? "selected" : null) ?> value="11">11º (11)</option>
                        <option <?php echo ($dias == "12" ? "selected" : null) ?> value="12">12º (12)</option>
                        <option <?php echo ($dias == "13" ? "selected" : null) ?> value="13">13º (13)</option>
                        <option <?php echo ($dias == "14" ? "selected" : null) ?> value="14">14º (14)</option>
                        <option <?php echo ($dias == "15" ? "selected" : null) ?> value="15">15º (15)</option>
                        <option <?php echo ($dias == "16" ? "selected" : null) ?> value="16">16º (16)</option>
                        <option <?php echo ($dias == "17" ? "selected" : null) ?> value="17">17º (17)</option>
                        <option <?php echo ($dias == "18" ? "selected" : null) ?> value="18">18º (18)</option>
                        <option <?php echo ($dias == "19" ? "selected" : null) ?> value="19">19º (19)</option>
                        <option <?php echo ($dias == "20" ? "selected" : null) ?> value="20">20º (20)</option>
                        <option <?php echo ($dias == "21" ? "selected" : null) ?> value="21">21º (21)</option>
                        <option <?php echo ($dias == "22" ? "selected" : null) ?> value="22">22º (22)</option>
                        <option <?php echo ($dias == "23" ? "selected" : null) ?> value="23">23º (23)</option>
                        <option <?php echo ($dias == "24" ? "selected" : null) ?> value="24">24º (24)</option>
                        <option <?php echo ($dias == "25" ? "selected" : null) ?> value="25">25º (25)</option>
                        <option <?php echo ($dias == "26" ? "selected" : null) ?> value="26">26º (26)</option>
                        <option <?php echo ($dias == "27" ? "selected" : null) ?> value="27">27º (27)</option>
                        <option <?php echo ($dias == "28" ? "selected" : null) ?> value="28">28º (28)</option>
                        <option <?php echo ($dias == "29" ? "selected" : null) ?> value="29">29º (29)</option>
                        <option <?php echo ($dias == "30" ? "selected" : null) ?> value="30">30º (30)</option>
                        <option <?php echo ($dias == "31" ? "selected" : null) ?> value="31">31º (31)</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-group focused">
                      <label class="form-control-label" for="meses">Meses</label>
                      <input required type="text" data-parsley-pattern="/^(\*|([1-9]|1[0-2]?)(-([1-9]|1[0-2]?))?)(\/[1-9][0-9]*)?(,(\*|([1-9]|1[0-2]?)(-([1-9]|1[0-2]?))?)(\/[1-9][0-9]*)?)*$/" value="<?php echo $meses; ?>" name="meses" id="meses" class="form-control form-control-alternative">
                    </div>
                  </div>
                  <div class="col-8">
                    <div class="form-group focused">
                      <label class="form-control-label" for="canalmensagem">&nbsp;</label>
                      <select id="select_meses" onchange="select_single_option('meses')" class="form-control form-control-alternative">
                        <option <?php echo ($meses == "--" ? "selected" : null) ?> value="--">-- Configurações comuns --</option>
                        <option <?php echo ($meses == "*" ? "selected" : null) ?> value="*">A cada mês (*)</option>
                        <option <?php echo ($meses == "*/2" ? "selected" : null) ?> value="*/2">A cada dois meses (*/2)</option>
                        <option <?php echo ($meses == "*/4" ? "selected" : null) ?> value="*/4">A cada três meses (*/4)</option>
                        <option <?php echo ($meses == "1,7" ? "selected" : null) ?> value="1,7">A cada seis meses (1,7)</option>
                        <option <?php echo ($meses == "---" ? "selected" : null) ?> value="---">-- meses --</option>
                        <option <?php echo ($meses == "1" ? "selected" : null) ?> value="1">Janeiro (1)</option>
                        <option <?php echo ($meses == "2" ? "selected" : null) ?> value="2">Fevereiro (2)</option>
                        <option <?php echo ($meses == "3" ? "selected" : null) ?> value="3">Março (3)</option>
                        <option <?php echo ($meses == "4" ? "selected" : null) ?> value="4">Abril (4)</option>
                        <option <?php echo ($meses == "5" ? "selected" : null) ?> value="5">Maio (5)</option>
                        <option <?php echo ($meses == "6" ? "selected" : null) ?> value="6">Junho (6)</option>
                        <option <?php echo ($meses == "7" ? "selected" : null) ?> value="7">Julho (7)</option>
                        <option <?php echo ($meses == "8" ? "selected" : null) ?> value="8">Agosto (8)</option>
                        <option <?php echo ($meses == "9" ? "selected" : null) ?> value="9">Setembro (9)</option>
                        <option <?php echo ($meses == "10" ? "selected" : null) ?> value="10">Outubro (10)</option>
                        <option <?php echo ($meses == "11" ? "selected" : null) ?> value="11">Novembro (11)</option>
                        <option <?php echo ($meses == "12" ? "selected" : null) ?> value="12">Dezembro (12) </option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-4">
                    <div class="form-group focused">
                      <label class="form-control-label" for="diassemana">Dias da semana</label>
                      <input required type="text" data-parsley-pattern="/^(\*|[0-6](-[0-6])?)(\/[1-9][0-9]*)?(,(\*|[0-6](-[0-6])?)(\/[1-9][0-9]*)?)*$/" value="<?php echo $diassemana; ?>" name="diassemana" id="diassemana" class="form-control form-control-alternative">
                    </div>
                  </div>
                  <div class="col-8">
                    <div class="form-group focused">
                      <label class="form-control-label" for="canalmensagem">&nbsp;</label>
                      <select id="select_diassemana" class="form-control form-control-alternative" onchange="select_single_option('diassemana')">
                        <option <?php echo ($diassemana == "--" ? "selected" : null) ?> value="--"> -- Configurações comuns -- </option>
                        <option <?php echo ($diassemana == "*" ? "selected" : null) ?> value="*">A cada dia (*)</option>
                        <option <?php echo ($diassemana == "1-5" ? "selected" : null) ?> value="1-5">A cada dia da semana (1-5)</option>
                        <option <?php echo ($diassemana == "0,6" ? "selected" : null) ?> value="0,6">A cada dia do final de semana (6,0)</option>
                        <option <?php echo ($diassemana == "1,3,5" ? "selected" : null) ?> value="1,3,5">A cada segunda, quarta e sexta (1,3,5)</option>
                        <option <?php echo ($diassemana == "2,4" ? "selected" : null) ?> value="2,4">A cada terça e quinta (2,4)</option>
                        <option <?php echo ($diassemana == "---" ? "selected" : null) ?> value="---">-- Dias da semana --</option>
                        <option <?php echo ($diassemana == "0" ? "selected" : null) ?> value="0">Domingo (0)</option>
                        <option <?php echo ($diassemana == "1" ? "selected" : null) ?> value="1">Segunda-feira (1)</option>
                        <option <?php echo ($diassemana == "2" ? "selected" : null) ?> value="2">Terça-feira (2)</option>
                        <option <?php echo ($diassemana == "3" ? "selected" : null) ?> value="3">Quarta-feira (3)</option>
                        <option <?php echo ($diassemana == "4" ? "selected" : null) ?> value="4">Quinta-feira (4)</option>
                        <option <?php echo ($diassemana == "5" ? "selected" : null) ?> value="5">Sexta-feira (5)</option>
                        <option <?php echo ($diassemana == "6" ? "selected" : null) ?> value="6">Sábado (6)</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <hr class="my-4">
            <button id="button" type="submit" class="btn btn-primary btn-lg float-right">Salvar</button> 
            <a href="<?php echo base_url("admin/tw") ?>" class="mr-3 btn btn-warning btn-lg float-right">Cancelar</a> 
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
      function select_common_option() {
          var opcao = $("#common_options").val();
          var arrayOpcoes = opcao.split(" ");
          var minutos = arrayOpcoes[0];
          $("#minutos").val(minutos);
          $("#select_minutos").val(minutos);
          var horas = arrayOpcoes[1];
          $("#horas").val(horas);
          $("#select_horas").val(horas);
          var dias = arrayOpcoes[2];
          $("#dias").val(dias);
          $("#select_dias").val(dias);
          var meses = arrayOpcoes[3];
          $("#meses").val(meses);
          $("#select_meses").val(meses);
          var diassemana = arrayOpcoes[4];
          $("#diassemana").val(diassemana);
          $("#select_diassemana").val(diassemana);

      }

      function select_single_option(opcao) {
          $("#" + opcao).val($("#select_" + opcao).val());
          var periodo = $("#minutos").val() + " " + $("#horas").val() + " " + $("#dias").val() + " " + $("#meses").val() + " " + $("#diassemana").val();
          if ($("#common_options option[value='" + periodo + "']").length > 0) {
              $("#common_options").val(periodo);
          }
      }

      (function () {
          var previous;

          $("#common_options").on('focus', function () {
              // Store the current value on focus and on change
              previous = this.value;
          }).change(function () {
              // Do something with the previous value after the change
              if (this.value === "--") {
                  $("#common_options").val(previous)
                  select_common_option();
              } else {
                  previous = this.value;
              }
          });
      })();
  </script>
