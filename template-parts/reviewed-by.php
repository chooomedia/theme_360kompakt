<?php
    $author_id = get_post_field('post_author'); 
    $author_name = get_the_author_meta('display_name',$author_id);
	$author_url = get_author_posts_url( $author_id );

    $reviewed_author_id = get_post_meta( $post->ID, 'custom_checked_by_author', true );
    $reviewed_author_name = get_the_author_meta('display_name',$reviewed_author_id );
    $reviewed_author_url = get_author_posts_url( $reviewed_author_id );
?>

<div class="author-info">

    <span>
        <img width="26" height="26" src="<?php echo get_avatar_url( $author_id ); ?>" alt="<?php echo $author_name; ?>" />
    </span>

    <span>
        <?php
        echo sprintf(
            __('Von %s %s %s', 'kompakt'),
            ( empty( is_archive() ) ? '<a href="' . $author_url . '" title="' . $author_name . '">' : '' ),
            $author_name,
            ( empty( is_archive() ) ? '</a>' : '' )
        );
        ?>
    </span>

    <?php if( !empty( $reviewed_author_id ) ): ?>
        <div class="reviewed-by">
            <span class="shield">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="20" height="20">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
                </svg>
            </span>
            <span>
                <?php
                echo sprintf( 
                    __('Überprüft durch %s %s %s', 'kompakt'), 
                    '<a href="' . $reviewed_author_url . '" title="' . $reviewed_author_name . '">',
                    $reviewed_author_name,
                    '</a>'
                );
                ?>
            </span>
        </div>
    <?php endif; ?>

            <?php 
            $calender = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 2v22h-24v-22h3v1c0 1.103.897 2 2 2s2-.897 2-2v-1h10v1c0 1.103.897 2 2 2s2-.897 2-2v-1h3zm-2 6h-20v14h20v-14zm-2-7c0-.552-.447-1-1-1s-1 .448-1 1v2c0 .552.447 1 1 1s1-.448 1-1v-2zm-14 2c0 .552-.447 1-1 1s-1-.448-1-1v-2c0-.552.447-1 1-1s1 .448 1 1v2zm1 11.729l.855-.791c1 .484 1.635.852 2.76 1.654 2.113-2.399 3.511-3.616 6.106-5.231l.279.64c-2.141 1.869-3.709 3.949-5.967 7.999-1.393-1.64-2.322-2.686-4.033-4.271z"/></svg>';

                    echo '
                    <div class="last-mod-date">
                        <span class="calender">
                            ' . $calender . '
                        </span>
                        <span>' . __('Zuletzt bearbeitet am: ', 'kompakt') . '<time>' . get_the_modified_date() . '</time></span>
                    </div>';  
            ?>

</div>