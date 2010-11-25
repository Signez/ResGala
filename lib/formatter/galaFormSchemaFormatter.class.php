<?php

class galaFormSchemaFormatter extends sfWidgetFormSchemaFormatter {
    protected
      $rowFormat                 = '<div class="wrapfield">
                                      <p class="wraplabel">%label%</p>
                                      <p class="wrapwidget">%field%</p>
                                      %error%
                                      %help%
                                    </div>',
      $helpFormat                = '<p class="wraphelp">%help%</p>',
      $errorRowFormat            = '<p class="wraperror">%errors%</p>',
      $errorListFormatInARow     = '<ul class="error_list">%errors%</ul>',
      $errorRowFormatInARow      = '<li>%error%</li>',
      $namedErrorRowFormatInARow = '<li>%name%: %error%</li>',
      $decoratorFormat           = '<dl id="formContainer">%content%</dl>';
}
?>