<?php 
	global $post;
	$current = get_post($post->ID);
	if($current->post_parent){      
		  $parent = get_post($current->post_parent);
		  if($parent->post_parent){
				$grandparent = get_post($parent->post_parent);
		  }
	}	
?>
<div class="child-sibling-links">
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<div class="cell small-12 large-10 large-offset-1">
				<nav class="page-nav">
					<img class="show-for-medium" src="<?php echo get_template_directory_uri(); ?>/assets/images/page-nav-bg.svg">
					<button class="hide-for-medium black-bg" type="button" id="page-nav-toggle"></button>
					<div class="page-nav-wrap">
						<div class="grid-x grid-margin-x flex-dir-column medium-flex-dir-row align-middle"<?php if( !is_page_template() ):?> data-smooth-scroll data-animation-easing="swing"<?php endif;?>>
	
							<?php
							
								if( !is_page_template() ) :
									$page_modules = get_field('page_modules');
									
									if( !empty($page_modules) ):
										foreach($page_modules as $page_module):
										$unique_ID = $page_module['unique_id'];
										//var_dump($page_module);
										
											if( !empty($unique_ID) ):
												$page_nav_link_title = $page_module['page_nav_link_title'];
					
	
									?>
										
										<div class="cell shrink relative">
											<a href="#<?php echo slugify($unique_ID);?>" title="<?php echo $page_nav_link_title; ?>"><?php echo $page_nav_link_title ; ?></a>
										</div>
										
											
										<?php 
											endif;
										endforeach;
									endif;
									
								else:
							
									if($parent && !$grandparent) {
										$args = array(
											'post_type'      => 'page',
											'posts_per_page' => -1,
											'post_parent'    => $parent->ID,
		 								);
									}
									elseif($parent && $grandparent) {
										$args = array(
											'post_type'      => 'page',
											'posts_per_page' => -1,
											'post_parent'    => $grandparent->ID,
										);
									}	
									else {
										$args = array(
											'post_type'      => 'page',
											'posts_per_page' => -1,
											'post_parent'    => $post->ID,
										);
									}					
									
									$loop = new WP_Query( $args );
		
									if ( $loop->have_posts() ) : ?>
									
										<?php if($parent && !$grandparent){?>
										
											<div class="cell shrink relative">
												<a href="<?php the_permalink($parent->ID); ?>" title="<?php the_title($parent->ID); ?>"><?php $title = get_the_title($parent->ID); echo $title; ?></a>
											</div>
											
										<?php } elseif($parent && $grandparent) { ?>
										
											<div class="cell shrink relative">
												<a href="<?php the_permalink($grandparent->ID); ?>" title="<?php the_title($grandparent->ID); ?>"><?php $title = get_the_title($grandparent->ID); echo $title; ?></a>
											</div>
											
										<?php } else { ?>
										
											<div class="cell shrink relative">
												<span class="is-active"><?php the_title(); ?></span>
											</div>
											
										<?php };?>
		
										<?php while ( $loop->have_posts() ) : $loop->the_post(); 
											
											$loop_ID = get_the_ID();
											$post_link_slug = $post->post_name;
											$pages = get_pages('child_of=' . $post->ID);
											
											if ( count($pages) > 0) {
												
												$child_args = array(
													'child_of' => $post->ID,
													'parent' => $post->ID
												);
												
												$pages = get_pages($child_args);												
											
											};
										?>
		
											<div class="link-wrap cell small-12 medium-shrink relative">
												<ul class="menu">
												<?php if (count($pages) > 0 && get_field('remove_from_sitemap')):?>
												<li>
													<button<?php if($current->post_parent == $loop_ID):?> class="is-active-parent"<?php endif;?> data-toggle="dropdown-for-<?php echo $loop_ID;?>"><?php the_title(); ?></button>
													<div class="dropdown-pane" id="dropdown-for-<?php echo $loop_ID;?>" data-dropdown  data-auto-focus="true" data-position="bottom" data-alignment="right" data-hover-delay="0" data-closing-time="0" data-close-on-click="true">
														<ul class="menu">
														<?php
														foreach ($pages as $page):?>
															<li<?php if( $page->ID ==  $current->ID):?> class="is-active is-active-page"<?php endif;?>><a href="<?php echo get_permalink($page->ID);?>"><?php echo $page->post_title;?></a></li>
  														<?php endforeach;?>
														</ul>
													</div>
												</li>
												<?php elseif ($parent->ID == $loop_ID):?>
													<li><span class="is-active is-active-page"><?php $title = get_the_title($parent->ID);  echo $title;?></span></li>
												<?php elseif ($post->ID ==  $current->ID):?>
													<li><span class="is-active is-active-page"><?php the_title();?></li>
												<?php else:?>
													<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
												<?php endif;?>
											</div>
				
										<?php endwhile; ?>
									
									<?php endif; wp_reset_postdata(); ?>	
									
								<?php endif;?>
							
						</div>
					</div>
					<div class="hide-for-medium chev-wrap">
						<svg xmlns="http://www.w3.org/2000/svg" width="24.447" height="13.638" viewBox="0 0 24.447 13.638">
						  <path id="Path_794" data-name="Path 794" d="M281,13884.472l11.516,11.517,11.516-11.517" transform="translate(-280.293 -13883.765)" fill="none" stroke="#019fdb" stroke-width="2"/>
						</svg>
					</div>
				</nav>
			</div>
		</div>
	</div>
</div>