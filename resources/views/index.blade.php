@extends('layouts.primary', ['solidNavBar' => true])
@section('title', 'Home - ')
@section('description', 'Cool, calm and collected oceanic control services in the North Atlantic on VATSIM.')

@section('content')
    <div style="height: calc(100vh - 74px); z-index: -1" class="z-depth-0 jarallax">
        <img src="https://media.discordapp.net/attachments/498332235154456579/695982036346994708/unknown.png" alt="" class="jarallax-img">
        <div class="flex-center mask rgba-black-light flex-column">
            <div class="container">
                <h1 class="display-2 fw-700 white-text">Cool. Calm. Collected.</h1>
                <h2 style="font-size:3em;" class="fw-500 mt-4 white-text">Welcome to Gander Oceanic.</h2>
            </div>
        </div>
    </div>
    <div class="jumbtron" style="margin-top: -100px; z-index: 999;">
        <div class="container blue z-depth-2 px-5 pt-5 pb-3 mb-5">
            <div class="row">
                <div class="col-md-6 mb-4">
                    {{-- <h2 class="font-weight-bold white-text mb-4">Latest News</h2>
                    <div class="list-group list-group-flush z-depth-1">
                        @foreach($news as $n)
                            <a href="" target="_blank" class="list-group-item list-group-item-action waves-effect blue">
                                <h4 class="fw-600 white-text">{{$n->title}}</h4>
                                <p class="white-text mb-0">
                                    {{$n->summary}}&nbsp;&nbsp;•&nbsp;&nbsp;{{$n->published->diffForHumans()}}
                                </p>
                            </a>
                        @endforeach
                    </div> --}}
                    <div class="view" style="height: 330px !important; @if($news->image) background-image:url({{$news->image}}); background-size: cover; background-position-x: center; @else background: var(--czqo-blue); @endif">
                        <div class="mask rgba-stylish-light flex-left p-4 justify-content-end d-flex flex-column h-100">
                            <div class="container">
                                <h1 class="font-weight-bold white-text">
                                    <a href="{{route('news.articlepublic', $news->slug)}}" class="white-text">
                                        {{$news->title}}
                                    </a>
                                </h1>
                                <p class="white-text" style="font-size: 1.3em;">
                                    {{$news->summary}}
                                </p>
                                <a href="{{route('news')}}" class="white-text" style="font-size: 1.2em;">All Articles <i class="fas fa-arrow-right"></i> </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="d-flex flex-row-justify-content-between align-items-center">
                        <h2 class="white-text font-weight-bold">Online Oceanic Controllers</h2>
                        <a href="{{route('map')}}" class="float-right ml-auto mr-0 white-text" style="font-size: 1.2em;">View map&nbsp;&nbsp;<i class="fas fa-map"></i></a>
                    </div>
                    <ul class="list-unstyled ml-0 mt-3 p-0 onlineControllers">
                        @if(count($controllers) < 1)
                        <li class="mb-2">
                            <div class="d-flex flex-row justify-content-between align-items-center mb-1">
                                <h4 class="m-0 white-text"><i class="fas fa-sad-tear" style="margin-right: 1rem;"></i>No controllers online</h4>
                            </div>
                        </li>
                        @endif
                        @foreach($controllers as $controller)
                        <li>
                            <div class="white-text d-flex flex-row justify-content-between align-items-center">
                                <h4 class="font-weight-bold m-0">{{$controller['callsign']}}</h4>
                                <div style="font-size: 1.1em;">
                                    @if ($rosterMember = App\Models\Roster\RosterMember::where('cid', $controller['cid'])->first())
                                        <img src="{{$rosterMember->user->avatar()}}" style="height: 35px; !important; width: 35px !important; margin-left: 10px; margin-right: 5px; margin-bottom: 3px; border-radius: 50%;">
                                        {{$rosterMember->user->fullName('FLC')}}
                                    @else
                                        <div class="my-1">
                                            {{$controller['realname']}} {{$controller['cid']}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </li>
                        <hr class="my-2">
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="d-flex flex-row justify-content-left">
                    <img style="margin-top: -7px;height: 80px;" src="{{asset('img/Twitter_Logo_Blue.png')}}" alt="">
                    <div>
                        <h2 class="font-weight-bold blue-text">Latest Tweets</h2>
                        <a href="https://twitter.com/ganderocavatsim/" class="text-body">
                            <p class="mt-0 fw-400" style="font-size: 1.2em;">@ganderocavatsim</p>
                        </a>
                    </div>
                </div>
                <div class="list-group z-depth-1">
                    @if($tweets)
                    @foreach($tweets as $t)
                        <a href="https://twitter.com/ganderocavatsim/status/{{$t['id']}}" target="_blank" class="list-group-item list-group-item-action waves-effect">
                            <p>
                                {{$t['text']}}
                            </p>
                            <p class="text-muted mb-0">
                                {{Carbon\Carbon::create($t['created_at'])->diffForHumans()}}
                                @if($t['retweeted'])
                                &nbsp;&nbsp;•&nbsp;&nbsp;
                                <i class="fas fa-retweet"></i>
                                Retweet of {{$t['retweeted_status']['user']['name']}}
                                @endif
                                @if($t['in_reply_to_user_id'])
                                &nbsp;&nbsp;•&nbsp;&nbsp;
                                <i class="fas fa-reply"></i>
                                In Reply To {{$t['in_reply_to_screen_name']}}
                                @endif
                            </p>
                        </a>
                    @endforeach
                    @else
                    No tweets found
                    @endif
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <h2 class="font-weight-bold blue-text mb-4">Our Newest Controllers</h2>
                @foreach ($certifications as $cert)
                    <div class="d-flex flex-row mb-2">
                        <img src="{{$cert->controller->avatar()}}" style="height: 55px !important; width: 55px !important; margin-right: 10px; margin-bottom: 3px; border-radius: 50%;">
                        <div class="d-flex flex-column">
                            <h4 class="fw-400">{{$cert->controller->fullName('FL')}}</h4>
                            <p title="{{$cert->timestamp->toDayDateTimeString()}}">{{$cert->timestamp->diffForHumans()}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-4 mb-4">
                <h2 class="font-weight-bold blue-text mb-4">Top Controllers</h2>
                <ul class="list-unstyled">
                    @php $index = 1; @endphp
                    @foreach($topControllers as $c)
                    <li class="mb-1">
                        <div class="d-flex flex-row">
                            <span class="font-weight-bold blue-text" style="font-size: 1.9em;">
                                @if($index == 1)
                                <i class="fas fa-trophy amber-text fa-fw"></i>
                                @elseif ($index == 2)
                                <i class="fas fa-trophy blue-grey-text fa-fw"></i>
                                @elseif ($index == 3)
                                <i class="fas fa-trophy brown-text fa-fw"></i>
                                @else
                                {{$index}}.
                                @endif
                            </span>
                            <p class="mb-0 ml-1">
                                <span style="font-size: 1.4em;">
                                    <img src="{{$c->user->avatar()}}" style="height: 35px; !important; width: 35px !important; margin-left: 10px; margin-right: 5px; margin-bottom: 3px; border-radius: 50%;">
                                    <div class="d-flex flex-column ml-2">
                                        <h4 class="fw-400">{{$c->user->fullName('FL')}}</h4>
                                        <p>{{$c->monthly_hours}} hours this month</p>
                                    </div>
                                </span>
                            </p>
                        </div>
                    </li>
                    @php $index++; @endphp
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-7 mb-4">
                <h1 class="font-weight-bold blue-text">We control the skies over the North Atlantic on VATSIM.</h1>
                <p style="font-size: 1.2em;" class="mt-3">
                    Gander Oceanic is VATSIM's coolest, calmest and most collected provider of Oceanic control. With our worldwide team of skilled Oceanic controllers, we pride ourselves on our expert, high-quality service to pilots flying across the North Atlantic. Our incredible community of pilots and controllers extend their warmest welcome and wish you all the best for your oceanic crossings!
                </p>
                <p style="font-size: 1.2em;" class="mt-3">
                    <a class="font-weight-bold text-body" href="{{route('about.who-we-are')}}">Who we are &nbsp;&nbsp;<i class="fas fa-arrow-right blue-text"></i></a>
                </p>
                <div class="d-flex flex-row">
                    @if(!Auth::check() || Auth::user()->can('start-application'))
                    <a href="{{route('training.applications.apply')}}" role="button" class="btn bg-czqo-blue-light">Apply Now</a>
                    @endif
                    <a href="/pilots" class="btn bg-czqo-blue-light" role="button">Pilot Resources</a>
                </div>
            </div>

            <div class="col-lg-5 text-right">
                <h2 class="font-weight-bold mb-3 blue-text">Quick Links</h2>
                <div clss="list-group mt-4 z-depth-2" style="font-size: 1.3em;">
                    <div class="list-group-item">
                        <a data-toggle="modal" data-target="#discordTopModal" href="" style="text-decoration:none;">
                            <span class="blue-text">
                                <i class="fab fa-discord fa-2x" style="vertical-align:middle;"></i>
                            </span>
                            &nbsp;
                            <span class="blue-text">Join Our Discord Community</span>
                        </a>
                    </div>
                    <div class="list-group-item">
                        <a href="https://twitter.com/ganderocavatsim" style="text-decoration:none;">
                            <span class="blue-text">
                                <i class="fab fa-twitter fa-2x" style="vertical-align:middle;"></i>
                            </span>
                            &nbsp;
                            <span class="blue-text">Twitter</span>
                        </a>
                    </div>
                    <div class="list-group-item">
                        <a href="https://www.facebook.com/ganderocavatsim" style="text-decoration:none;">
                            <span class="blue-text">
                                <i class="fab fa-facebook fa-2x" style="vertical-align:middle;"></i>
                            </span>
                            &nbsp;
                            <span class="blue-text">Facebook</span>
                        </a>
                    </div>
                    <div class="list-group-item">
                        <a href="https://www.youtube.com/channel/UC3norFpW3Cw4ryGR7ourjcA" style="text-decoration:none;">
                            <span class="blue-text">
                                <i class="fab fa-youtube fa-2x" style="vertical-align:middle;"></i>
                            </span>
                            &nbsp;
                            <span class="blue-text">YouTube Channel</span>
                        </a>
                    </div>
                    <div class="list-group-item">
                        <a href="https://knowledgebase.ganderoceanic.com" style="text-decoration:none;">
                            <span class="blue-text">
                                <i class="fas fa-book fa-2x" style="vertical-align:middle;"></i>
                            </span>
                            &nbsp;
                            <span class="blue-text">Knowledge Base</span>
                        </a>
                    </div>
                </ul>
            </div>
        </div>
    </div>
    <script> /*
        jarallax(document.querySelectorAll('.jarallax'), {
            speed: 0.5,
            videoSrc: 'mp4:https://cdn.ganderoceanic.com/resources/media/video/ZQO_SITE_TIMELAPSE.mp4',
            videoLoop: true,
            zIndex: 5
        }); */
        $('.jarallax').jarallax({
            speed: 0.2,
            zIndex: -1
        });
        snowStorm();
    </script>

@endsection

