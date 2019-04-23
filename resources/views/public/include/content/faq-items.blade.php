<v-expansion-panel>
    @if($items)
        @foreach($items as $faq)
            <v-expansion-panel-content>
                <template v-slot:header>
                    <div>{{$faq->title}}</div>
                </template>
                <v-card>
                    <v-card-text class="grey lighten-3">{!! $faq->text !!}</v-card-text>
                </v-card>
            </v-expansion-panel-content>
        @endforeach
    @endif
</v-expansion-panel>