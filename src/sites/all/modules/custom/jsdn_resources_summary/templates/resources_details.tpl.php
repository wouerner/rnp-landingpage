<?php
$json  = $server_post;
$data = json_decode($json,true);
$order   = array("\r\n", "\n", "\r","\t");
$JsonData = str_replace($order,'',$data['view-resource-details']['resource-details']);
$resourceDetails = json_decode($JsonData,true);?>
 <div class="container-fluid resource-detail">
    <div class="row"> 
        <div class="container"> 
                <div class="col-md-12">
                    <h3 class="resource-title"><?php echo @$data['view-resource-details']['resource-type-name'];?> Details</h3>
                    <div class="container row relative">
                      <h5 class="resource-name"><?php echo @$data['view-resource-details']['resource-name'];?></h5>
                      <div class="right absolute top action-list action-dropdown">
                          <?php if($resourceDetails['actions']){?>
                            <input type="hidden" class="actionJson" value='<?php echo json_encode( $resourceDetails['actions'] );?>' />
                            <ul class="nav">
                              <li class="dropdown">
                              <a class="dropdown-toggle" data-toggle="dropdown" href="#">Actions
                              <span class="caret"></span></a> 
                              <ul class="dropdown-menu">
                              <?php foreach($resourceDetails['actions'] as $a => $action){?>
                                <li><a href="#" key="<?php echo $action['code'];?>"><?php echo $action['label'];?></a></li>
                              <?php }?> 
                              </ul>
                              </li>
                            </ul>
                          <?php }?>
                      </div>
                      <?php if($resourceDetails['resource-details']){?>
                      <ul  class="list-inline resource-tabs">
                          <?php foreach($resourceDetails['resource-details'] as $k=>$resource_details){?>
                              <li <?php if($k == 0){?>class="active"<?php }?>><a  href="#<?php echo $resource_details['code'];?>" data-toggle="tab"><?php echo $resource_details['label'];?></a></li>
                          <?php }?>
                      </ul>
                        <?php }else{?>
                            <div class="divider"></div>
                            <div class="serverError">
                                <?php print t('The requested details are not available currently. Please check again later.');?></div>
                        <?php }?>
                      <div class="tab-content clearfix">
                          <?php foreach($resourceDetails['resource-details'] as $k=>$resource_details){?>
                          <div class="tab-pane <?php if($k == 0){?>active<?php }?>" id="<?php echo $resource_details['code'];?>">
                          <?php if($resource_details['actions']){?>
                          <div class="action-list">
                            <input type="hidden" class="actionJson" value='<?php echo json_encode( $resource_details['actions'] );?>' />
                            <?php foreach( $resource_details['actions'] as $sectionAction){?>
                              <a href="#" key="<?php echo $sectionAction['code'];?>"><?php echo $sectionAction['label'];?></a>
                            <?php }?>
                          </div>
                          <?php }?>
                          <?php if($resource_details['note']){?><span class="resource-note"><?php echo $resource_details['note'];?></span><?php }?>
                              <?php if($resource_details['properties']){
                                foreach($resource_details['properties'] as $key => $properties){?>
                              <div class="section">
                                <?php if($properties['label'] || $properties['note']){?>
                                  <div class="section-main <?php if($properties['label']){?>bordered<?php }?>">
                                      <h5 class="section-title"><?php echo @$properties['label'];?></h5>
                                      <?php if(@$properties['note']){?><span class="section-note"><?php echo @$properties['note'];?></span><?php }?>
                                  </div>
                                <?php }?>
                                  <div class="container row resource-details">
                                    <?php if($properties['actions']){?>
                                      <div class="action-list">
                                        <input type="hidden" class="actionJson" value='<?php echo json_encode( $properties['actions'] );?>' />
                                            <?php foreach($properties['actions'] as $a => $propAction){?>
                                              <div class="btn btn-primary actionButton"><a href="#" key="<?php echo $propAction['code'];?>"><?php echo $propAction['label'];?></a></div>
                                            <?php }?> 
                                      </div>
                                    <?php }?>
                                    <?php if(strpos($key, 'section') !== false){
                                            $SectionOrderedValues = "";
                                            foreach($properties['order'] as $order){
                                              $SectionOrderedValues[$order] = $properties['values'][$order];
                                            }
                                      if($properties['values']){
                                        foreach($SectionOrderedValues as $left => $right){?> 
                                    <div class="row">
                                      <div class="left"><?php echo $left;?>:</div>
                                      <div class="right"><?php if(is_array($right)){
                                        foreach($right as $r){
                                        echo $r.','; 
                                        }
                                        }else{echo $right;}?></div>
                                    </div>
                                    <?php } }?>
                                    <?php }else if(strpos($key, 'table') !== false ){?>
                                      <table class="table table-bordered table-responsive">
                                          <thead>
                                              <tr>
                                                <?php foreach($resource_details['properties'][$key]['order'] as $title){?>
                                                <th><?php echo $title;?></th>
                                                <?php }?>
                                              </tr>
                                          </thead>
                                          <tbody>
                                              <?php if($resource_details['properties'][$key]['values']){
                                              $TableOrderedValues = "";
                                              foreach($resource_details['properties'][$key]['values'] as $k => $tableValue){
                                                foreach ($resource_details['properties'][$key]['order'] as $order => $orderValue) {
                                                  $TableOrderedValues[$k][$orderValue] = $tableValue[$orderValue];
                                                }
                                              }
                                              foreach ($TableOrderedValues as $key => $value) {?>
                                                <tr>
                                                  <?php foreach($value as $TableRow){?>
                                                    <?php if(!is_array($TableRow)){?>
                                                      <td><?php echo $TableRow;?></td>
                                                    <?php }else{
                                                      if(!empty($TableRow)){?>
                                                        <td><div class="action-list">
                                                        <input type="hidden" class="actionJson" value='<?php echo json_encode( $TableRow );?>' />
                                                        <?php foreach($TableRow as $action){?>
                                                          <a href="#" key="<?php echo $action['code'];?>"><?php echo $action['label'];?></a>
                                                          <?php }?></div></td>
                                                      <?php }else{?>
                                                      <td>-</td>
                                                      <?php }
                                                    }?>
                                                  <?php }?>
                                                </tr>
                                              <?php }
                                              }else{?>
                                              <tr><td colspan="<?php echo count($resource_details['properties'][$key]['order']);?>" style="text-align: center;">No data found.</td></tr>
                                              <?php }?>
                                          </tbody>
                                      </table>
                                    <?php }?>
                                  </div>
                              </div>
                              <?php }}?>
                          </div>
                          <?php }?>
                      </div>
                        <div class="backDiv">
                            <a href="/cms/resource-summary" class="backbutton">Back</a>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div> 