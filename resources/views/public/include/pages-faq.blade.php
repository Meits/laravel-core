<div>

    <v-flex xs12 class="my-3">
        <div class="text-xs-center">
            <h1 class="headline">{{$page->titleH1}}</h1>
            <span class="subheading">
                {!! $page->text !!}
              </span>
        </div>
    </v-flex>

    {!! $pageContent !!}

</div>