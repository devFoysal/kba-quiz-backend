<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">

      <li
        class="@if(trim($__env->yieldContent('title')=='Quiz') || trim($__env->yieldContent('title')=='Add new quiz')){{'active'}} @endif treeview">
        <a href="{{URL::to('management/quiz/list')}}">
          <i class="fa fa-sliders"></i> <span>All Quiz</span>
        </a>
      </li>

      <li
        class="@if(trim($__env->yieldContent('title')=='Questions') || trim($__env->yieldContent('title')=='Add new question')){{'active'}} @endif treeview">
        <a href="{{URL::to('management/question/list')}}">
          <i class="fa fa-sliders"></i> <span>All Questions</span>
        </a>
      </li>

       <li
        class="@if(trim($__env->yieldContent('title')=='Questions') || trim($__env->yieldContent('title')=='Add new question')){{'active'}} @endif treeview">
        <a href="{{URL::to('management/quiz/leaderboard')}}">
          <i class="fa fa-sliders"></i> <span>Leaderboard</span>
        </a>
      </li>

    </ul>
  </section>
</aside>