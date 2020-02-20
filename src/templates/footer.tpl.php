 
   <section class="navigation-horizontal">
      <div class="container-fluid">
         <ul class="bottom-list-links">
            <li class="navigation-item"><a class="navigation-link" href="http://www.vivo.com.br/portalweb/appmanager/env/web?_nfpb=true&_nfls=false&_pageLabel=vcAtendLojasBook#" title="Encontre uma Loja" target="_blank">Encontre uma Loja</a></li>
            <li class="navigation-item"><a class="navigation-link" href="http://www.vivo.com.br/consumo/groups/public/documents/documentopw/ucm_023328.pdf" title="Código de Defesa do Consumidor" target="_blank">Código de Defesa do Consumidor</a></li>
            <li class="navigation-item"><a class="navigation-link" href="http://www.vivo.com.br/portalweb/appmanager/env/web?_nfls=false&_nfpb=true&_pageLabel=vivoVcAtendFaleTelefonesUteisPage&WT.ac=portal.atendimento.faleconosco.telefonesdeatendimento#" title="Telefones de Atendimento" target="_blank">Telefones de Atendimento</a></li>            
            <li class="navigation-item"><a class="navigation-link" href="https://assine.vivo.com.br/empresas/pequenas-e-medias/atendimento/cloud" title="Contato" target="_blank">Contato</a></li>
            <li class="navigation-item"><a class="navigation-link" href="http://www.vivo.com.br/portalweb/appmanager/env/web?_nfpb=true&_nfls=false&_pageLabel=vivoVivoInstPrivacidadePage&__utma=1.257681268.1404996843.1406924132.1406924132.1&__utmb=1.105.8.1406928330350&__utmc=1&__utmx=-&__utmz=1.1406924132.1.1.utmcsr=(direct)|utmccn=(direct)|utmcmd=(none)&__utmv=1.|1=cliente=SP=1&__utmk=77745044#" title="Privacidade" target="_blank">Privacidade</a></li>
            <li class="navigation-item"><a class="navigation-link" href="http://www.vivo.com.br/portalweb/appmanager/env/web?_nfpb=true&_nfls=false&_pageLabel=AVivoAMarBook#" title="A Vivo" target="_blank">A Vivo</a></li>
            <li class="navigation-item"><a class="navigation-link" href="http://www.telefonica.com.br/" title="Telefônica Brasil" target="_blank">Telefônica Brasil</a></li>
            <li class="navigation-item"><a class="navigation-link" href="http://www.vivo.com.br/portalweb/appmanager/env/web?_nfls=false&_nfpb=true&_pageLabel=P43800274571360174849344&WT.ac=portal.amarca.segurancadainformacao#" title="Segurança" target="_blank">Segurança</a></li>
         </ul>
      </div>
   </section>

   <section class="footer-labels">
      <div class="container-fluid">
         <div class="content-labels">            
            <div class="label"><img src="<?php echo $file_path; ?>/images/label-telefonica-b2b.jpg" alt="Telefonica"></div>
            <div class="label"><img src="<?php echo $file_path; ?>/images/img-jogue-junto.png" alt="Vivo. Patrocinadora Oficial da Seleção dos Brasileiros."></div>
            <div class="label"><img src="<?php echo $file_path; ?>/images/logo-viva-tudo-empresas.png" alt="Viva Tudo"></div>
         </div>
      </div>
   </section>
</footer>






















<div id="footer-wrapper"><div class="section">

    <?php if ($page['footer_firstcolumn'] || $page['footer_secondcolumn'] || $page['footer_thirdcolumn'] || $page['footer_fourthcolumn']): ?>
      <div id="footer-columns" class="clearfix">
        <?php print render($page['footer_firstcolumn']); ?>
        <?php print render($page['footer_secondcolumn']); ?>
        <?php print render($page['footer_thirdcolumn']); ?>
        <?php print render($page['footer_fourthcolumn']); ?>
      </div> 
    <?php endif; ?>
	
	<?php if ($page['footer_left']): ?>
      <div id="footerLeft">
        <?php print render($page['footer_left']); ?>
      </div> 
    <?php endif; ?>

    <?php if ($page['footer']): ?>
      <div id="footer">
        <?php print render($page['footer']); ?>
      </div> 
    <?php endif; ?>

  </div></div>