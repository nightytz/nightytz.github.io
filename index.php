<?php
include_once 'header.php';
?>
<div class="lyear-wrapper">
    <section class="mt-5 pb-5">
        <div class="container">

            <div class="row">
                <!-- 文章列表 -->

                <div class="col-xl-8">


                    <?php
                    include_once 'common/Page.class.php';
                    $page=isset($_GET['page'])? $_GET['page']:1;
                    $subPages=5;
                    $start =($page-1)*$subPages;
                    $result=$conn->query("select a.id,a.title,a.n,a.author,b.class_name,a.c_time,a.content,a.keyword from article as a,cate as b where a.cateid=b.id order by a.id desc limit $start,$subPages");

                    while($row=$result->fetch_assoc()){


                    ?>
                    <article class="lyear-arc">
                        <div class="arc-header">
                            <h2 class="arc-title"><a href="post.php?id=<?php echo $row['id']?>"><?php echo $row['title']?></a></h2>
                            <ul class="arc-meta">
                                <li><i class="mdi mdi-calendar"></i> <?php echo date("Y-m-d H:i:s",$row['c_time']);?></li>
                                <li><i class="mdi mdi-calendar"></i><?php echo $row['class_name'];?></li>
                                <li><i class="mdi mdi-tag-text-outline"></i><?php echo $row['keyword'];?></li>

                            </ul>
                        </div>

                        <div class="arc-synopsis">
                            <?php echo $row['content'];?>
                        </div>
                    </article>

                    <?php  }?>





                    <!-- 分页 -->
                    <div class="row">
                        <div class="col-lg-12">
                            <?php

                            $result_2=$conn->query("select * from article as a,cate as b where a.cateid=b.id order by a.id desc");
                            $result_count=$result_2->num_rows;
                            $p=new Page($result_count,4,$page,$subPages);
                            echo $p->showPages(1);
                            ?>
                        </div>
                    </div>
                    <!-- 分页 end -->
                </div>
                <!-- 内容 end -->

                <!-- 侧边栏 -->
<?php
include_once 'right.php';
?>
                <!-- 侧边栏 end -->
            </div>

        </div>
        <!-- end container -->
    </section>
</div>
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.nicescroll.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/main.min.js"></script>
</body>
</html>
