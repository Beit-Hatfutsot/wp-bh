<section id="donate-process-bottom" class="donate-process-layout">

    <div class="container">

        <h4><?php esc_html_e('Financial Information', 'BH') ?></h4>
        <div class="row">

            <?php
            $docs = array(
                    'proper_management_approval' => esc_html__('Proper Management Approval Document', 'BH'),
                    'article46_approval' => esc_html__('IRS public institution & article 46 Approval', 'BH'),
                    'annual_report' => esc_html__('Annual Report', 'BH'),
            );

            foreach ($docs as $doc => $doc_title) {

                $doc_file = get_field($doc, 'option');
                $doc_year = get_field($doc . '_year', 'option');
                if ( $doc_year ) {
                    $doc_title = $doc_title. ' - ' . $doc_year;
                }
                $tooltip = ( $doc_file ? esc_html__('Click to download the document', 'BH') : esc_html__('File Unavailable', 'BH') );

                echo '<div class="col-sm-4"><a href="' . $doc_file . '" role="link" class="' . ( $doc_file ? '' : 'file-na' ) . '" title="' . $tooltip . '" download>' . $doc_title . ' ' . esc_html__('(PDF)', 'BH')  . '</a></div>';
            }
            ?>
        </div>


    </div>
	
</section>