<!DOCTYPE html>
<x-app-layout>    
    <section class="py-6 sm:py-12 dark:bg-gray-100 dark:text-gray-800 bg-white rounded-md shadow-md">
    	<div class="container p-6 mx-auto space-y-8">
    		<div class="space-y-2 text-center">
    			<h2 class="text-3xl font-bold">Health Management App</h2>
    			<p class="font-serif text-sm dark:text-gray-600">あなたの健康管理をサポートします。</p>
    		</div>
    		
    		  <div class="container max-w-6xl p-6 mx-auto space-y-6 sm:space-y-12">
            <div class="grid grid-cols-3 gap-4">
               <div class="col-start-1 col-span-1 mt-8">              
                <div class="flex flex-col justify-center max-w-xs p-6 shadow-xl rounded-xl sm:px-12 dark:bg-gray-50 dark:text-gray-800">
                	<img src="{{ $user->image_path }}" alt="画像が読み込めません" class="w-32 h-32 mx-auto rounded-full dark:bg-gray-500 aspect-square">
                	<div class="space-y-4 text-center divide-y dark:divide-gray-300">
                		<div class="my-2 space-y-1">
                			<h2 class="text-xl font-semibold sm:text-2xl">{{ $user->name }}</h2>
                			<span class="text-xs dark:text-gray-600">{{ $user->updated_at }}</span>
                      <p class="px-5 text-xs sm:text-base dark:text-gray-600">性別：{{ $user->sex }}</p>
                      <p class="px-5 text-xs sm:text-base dark:text-gray-600">身長(cm)：{{ $user->height }}</p>   
                      <p class="px-5 text-xs sm:text-base dark:text-gray-600">体重(kg)：{{ $user->body_weight }}</p> 
                      <p class="px-5 text-xs sm:text-base dark:text-gray-600">年齢：{{ $user->age}}</p> 
                		</div>
                	</div>
                </div>              
              </div>
             <div class="col-start-2 col-span-2 bg-gradient-to-br from-blue-50 to-blue-200 rounded-3xl p-10 shadow-xl">
                <div>
                    <h4 class="text-2xl font-extrabold leading-8 tracking-tight text-gray-900 dark:text-white sm:leading-9 pb-5">
                        Goal Setting
                    </h4>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-start-1 col-span-1">
                            <ul class="mt-10">
                            <li>
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center w-12 h-12 text-white bg-white rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="_x32_" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" style="width: 35px; height: 35px; opacity: 1;" xml:space="preserve">
                                            <style type="text/css">
                                            
                                            	.st0{fill:#4B4B4B;}
                                            
                                            </style>
                                            <g>
                                            	<path class="st0" d="M371.884,0c-56.563,0-102.406,56.594-102.406,120.469c0,38.875,18.281,73.156,40.625,94.5   c19.609,18.75,31.656,33.188,34.063,64.516v206.563c0,14.328,11.625,25.953,25.953,25.953h3.516   c14.328,0,25.953-11.625,25.953-25.953V279.484c2.406-31.328,14.453-45.766,34.063-64.516c22.344-21.344,40.625-55.625,40.625-94.5   C474.274,56.594,428.415,0,371.884,0z" style="fill: rgb(75, 75, 75);"/>
                                            	<path class="st0" d="M188.587,24.547v109.375c0,6.984-5.656,12.656-12.641,12.656h-3.391c-6.969,0-12.641-5.672-12.641-12.656   V24.047c0-18.016-12.125-23.422-23.766-23.422c-11.625,0-23.75,5.406-23.75,23.422v109.875c0,6.984-5.672,12.656-12.656,12.656   h-3.375c-6.984,0-12.641-5.672-12.641-12.656V24.547c0-32.266-46-31.172-46,0.359c0,37.75,0,104.438,0,104.438   c-0.219,58,13.641,73.047,36.516,91.125c18.438,14.563,34.203,22.875,34.203,59.031v206.547c0,14.328,11.609,25.953,25.953,25.953   h3.516c14.328,0,25.953-11.625,25.953-25.953V279.5c0-36.156,15.75-44.469,34.188-59.031c22.891-18.078,36.75-33.125,36.531-91.125   c0,0,0-66.688,0-104.438C234.587-6.625,188.587-7.719,188.587,24.547z" style="fill: rgb(75, 75, 75);"/>
                                            </g>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg font-bold leading-6 text-gray-900 dark:text-white">
                                            Meal
                                        </h5>
                                        <p class="mt-2 text-base leading-6 text-gray-500 dark:text-gray-300">
                                            目標カロリー(kcal)：{{ $user->target_cal }}
                                        </p>
                                        <p class="mt-2 text-base leading-6 text-gray-500 dark:text-gray-300">
                                            目標タンパク質(g)：{{ $user->target_protein }}
                                        </p>
                                        <p class="mt-2 text-base leading-6 text-gray-500 dark:text-gray-300">
                                            目標脂質(g)：{{ $user->target_fat }}
                                        </p>
                                        <p class="mt-2 text-base leading-6 text-gray-500 dark:text-gray-300">
                                            目標炭水化物(g)：{{ $user->target_carbo }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-8">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center w-12 h-12 text-white bg-white rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="_x32_" x="0px" y="0px" viewBox="0 0 512 512" style="width: 35px; height: 35px; opacity: 1;" xml:space="preserve">
                                            <style type="text/css">
                                            	.st0{fill:#4B4B4B;}
                                            </style>
                                            <g>
                                            	<path class="st0" d="M264.144,416.889L14.642,205.12L0,222.38l249.532,211.798l0.034,0.03   c28.365,23.868,64.366,37.003,101.443,37.01h159.922v-22.638H351.01C319.292,448.581,288.402,437.322,264.144,416.889z"/>
                                            	<path class="st0" d="M203.394,336.186l56.013,47.136c-2.07-10.412-6.623-21.543-15.617-31.812   c-6.968-7.966-21.928-24.401-39.924-44.533C203.397,316.698,203.21,326.524,203.394,336.186z"/>
                                            	<path class="st0" d="M141.098,205.698c-9.717-8.664-18.354-16.682-25.496-23.824c6.923,10.704,13.333,20.425,22.882,32.494   C139.323,211.511,140.198,208.624,141.098,205.698z"/>
                                            	<path class="st0" d="M194.91,251.657c-14.556-12.107-28.463-23.816-41.054-34.745c-0.893,4.133-1.785,8.371-2.64,12.729   c9.852,11.312,22.541,24.874,39.826,42.291C192.187,265.361,193.466,258.587,194.91,251.657z"/>
                                            	<path class="st0" d="M330.506,424.022c-0.372-18.197-4.4-63.248-33.957-88.205c-27.911-23.568-59.254-49.094-88.812-73.532   c-0.912,7.576-1.751,15.587-2.46,23.838c1.938,1.92,3.889,3.841,5.929,5.836c40.044,39.253,71.222,70.09,74.808,113.228   C299.34,414.654,314.525,421.052,330.506,424.022z"/>
                                            	<path class="st0" d="M143.198,285.524l41.136,34.617c0.946-9.032,2.205-19.405,3.886-30.746   c-12.943-14.635-26.625-30.327-39.594-45.689C146.277,257.298,144.327,271.497,143.198,285.524z"/>
                                            	<path class="st0" d="M134.872,227.196c-20.23-24.656-37.018-46.956-43.656-60.473l5.58-6.683c-0.011-0.008-0.022-0.023-0.022-0.023   l6.676-8.266c0,0,17.463,16.742,42.478,39.05c4.013-11.837,8.547-23.936,13.682-35.975l9.5,3.586c0,0-5.555,17.357-11.623,42.605   c12.654,11.087,26.628,23.028,40.951,34.7c2.686-11.394,5.788-23.043,9.392-34.707l9.35,2.483c0,0-3.616,16.922-7.156,41.533   c15.355,12.174,30.777,23.681,45.052,33.132c61.016,40.431,102.772,82.721,107.136,147.785c20.744,0,66.91,0,109.11,0   c56.584,0,48.096-56.58,11.315-65.064c-24.809-5.731-56.685-18.895-56.685-18.895c-12.576-4.193-22.867-13.39-28.44-25.421   c0,0-1.373-2.902-3.679-7.824l-46.202,13.975c-5.049,1.522-10.378-1.335-11.904-6.376c-1.527-5.048,1.327-10.382,6.375-11.904   l43.526-13.165c-3.744-7.966-8.087-17.237-12.662-27.018l-43.172,13.058c-5.04,1.523-10.378-1.327-11.904-6.375   c-1.526-5.049,1.331-10.374,6.376-11.904l40.531-12.257c-4.313-9.256-8.607-18.475-12.575-27.041l-40.262,12.174   c-5.044,1.53-10.377-1.327-11.904-6.376c-1.522-5.04,1.328-10.373,6.372-11.896l37.715-11.409   c-5.404-11.77-9.335-20.485-10.374-23.186c-4.546-11.806-14.511-44.533-37.254-26.328   c-37.389,29.922-105.596,21.138-123.204-11.574c-13.202-24.52-5.66-50.924,0-71.672c4.519-16.585-18.869-42.441-35.844-19.81   c-12.002,16-113.171,135.806-113.171,135.806l100.457,84.537C127.228,257.77,130.544,243.151,134.872,227.196z"/>
                                            </g>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg font-bold leading-6 text-gray-900 dark:text-white">
                                            Movement
                                        </h5>
                                        <p class="mt-2 text-base leading-6 text-gray-500 dark:text-gray-300">
                                            目標運動消費カロリー(kcal)：{{ $user->target_movement_consumption_cal }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                        
                        
                    <div class="col-start-2 col-span-1 ml-4">
                        <ul class="mt-10">
                            <li class="mt-10">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center w-12 h-12 text-white bg-white rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="_x32_" x="0px" y="0px" viewBox="0 0 512 512" style="width: 35px; height: 35px; opacity: 1;" xml:space="preserve">
                                            <style type="text/css">
                                            	.st0{fill:#4B4B4B;}
                                            </style>
                                            <g>
                                            	<path class="st0" d="M469.332,0.004H42.668C19.101,0.004,0,19.104,0,42.673v426.655c0,23.567,19.101,42.668,42.668,42.668h426.664   c23.567,0,42.668-19.101,42.668-42.668V42.673C512,19.104,492.899,0.004,469.332,0.004z M364.37,191.877h-65.293l11.409-68.16   l-10.592-2.15l-10.6-2.167l-17.443,72.477H147.63l-28.151-81.902c39.867-24.026,86.578-37.868,136.529-37.868   c49.943,0,96.645,13.842,136.513,37.868L364.37,191.877z" style="fill: rgb(75, 75, 75);"/>
                                            </g>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg font-bold leading-6 text-gray-900 dark:text-white">
                                            Body Weight
                                        </h5>
                                        <p class="mt-2 text-base leading-6 text-gray-500 dark:text-gray-300">
                                            目標体重(kg)：{{ $user->target_body_weight }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="mt-32">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <div class="flex items-center justify-center w-12 h-12 text-white bg-white rounded-md">
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="_x32_" x="0px" y="0px" viewBox="0 0 512 512" style="width: 35px; height: 35px; opacity: 1;" xml:space="preserve">
                                            <style type="text/css">
                                            	.st0{fill:#4B4B4B;}
                                            </style>
                                            <g>
                                            	<path class="st0" d="M0,452.649c0,5.723,4.66,10.394,10.387,10.394h491.227c5.727,0,10.386-4.671,10.386-10.394V336.06H0V452.649z" style="fill: rgb(75, 75, 75);"/>
                                            	<path class="st0" d="M112.402,157.836v-40.792c0-10.732,8.706-19.446,19.422-19.446h95.188c10.708,0,19.418,8.714,19.418,19.446   v40.792c0,6.704-3.419,12.64-8.608,16.117h36.336c-5.186-3.478-8.589-9.413-8.589-16.117v-40.792   c0-10.732,8.691-19.446,19.418-19.446h95.189c10.716,0,19.398,8.714,19.398,19.446v40.792c0,6.704-3.399,12.64-8.584,16.117h51.362   l-8.588-18.684V80.123c0-17.208-13.954-31.167-31.167-31.167H109.402c-17.212,0-31.186,13.958-31.186,31.167v75.146l-8.569,18.684   h51.339C115.804,170.476,112.402,164.541,112.402,157.836z" style="fill: rgb(75, 75, 75);"/>
                                            	<polygon class="st0" points="452.072,195.134 59.928,195.134 0,325.721 512,325.721  " style="fill: rgb(75, 75, 75);"/>
                                            </g>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <h5 class="text-lg font-bold leading-6 text-gray-900 dark:text-white">
                                            Sleeping
                                        </h5>
                                        <p class="mt-2 text-base leading-6 text-gray-500 dark:text-gray-300">
                                            目標睡眠時間(hours)：{{ $user->target_sleeping_time }}
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                  </div>
                </div>
              </div>
           </div>
	    　</div>
    		
    		<div class="grid grid-cols-1 gap-x-4 gap-y-8 md:grid-cols-2 lg:grid-cols-4">
    			<article class="flex flex-col dark:bg-gray-50">
    				<a rel="noopener noreferrer" href="/myprofile/meal" aria-label="Te nulla oportere reprimique his dolorum">
    					<img alt="" class="object-cover w-full h-52 dark:bg-gray-500" src="/image/food.jpg">
    				</a>
    				<div class="flex flex-col flex-1 p-6 bg-red-50">
    					<h3 class="flex-1 py-2 text-lg font-semibold leading-snug">Meal Management</h3>
    					<div class="flex flex-wrap justify-between pt-3 space-x-2 text-xs dark:text-gray-600">
    						<span>適切な栄養バランスを保つことは、健康を維持するために不可欠です。バランスの取れた食事は、体に必要な栄養素を十分に摂取し、健康な体を維持するのに役立ちます。一方で、適切な食事管理は、慢性疾患や病気のリスクを低減するのにも役立ちます。</span>
    					</div>
    				</div>
    			</article>
    			<article class="flex flex-col dark:bg-gray-50">
    				<a rel="noopener noreferrer" href="/myprofile/movement" aria-label="Te nulla oportere reprimique his dolorum">
    					<img alt="" class="object-cover w-full h-52 dark:bg-gray-500" src="/image/running.jpg">
    				</a>
    				<div class="flex flex-col flex-1 p-6 bg-blue-50">
    					<h3 class="flex-1 py-2 text-lg font-semibold leading-snug">Movement Management</h3>
    					<div class="flex flex-wrap justify-between pt-3 space-x-2 text-xs dark:text-gray-600">
    						<span>定期的な運動は心臓血管系の健康を促進します。運動によって心臓の強化や血管の柔軟性が向上し、心臓病や高血圧などの疾患のリスクを軽減します。また、適切なトレーニングを行うことで筋肉を強化し、関節の柔軟性を維持・向上が見込めます。</span>
    					</div>
    				</div>
    			</article>
    			<article class="flex flex-col dark:bg-gray-50">
    				<a rel="noopener noreferrer" href="/myprofile/body_weight" aria-label="Te nulla oportere reprimique his dolorum">
    					<img alt="" class="object-cover w-full h-52 dark:bg-gray-500" src="/image/weighing-scale.jpg">
    				</a>
    				<div class="flex flex-col flex-1 p-6 bg-green-50">
    					<h3 class="flex-1 py-2 text-lg font-semibold leading-snug">Body Weight Management</h3>
    					<div class="flex flex-wrap justify-between pt-3 space-x-2 text-xs dark:text-gray-600">
    						<span>過体重や肥満は、心臓血管系の疾患のリスクを高める要因です。過剰な体重は高血圧や動脈硬化、心臓病などの心血管疾患の発症リスクを増加させる可能性があります。適切な体重管理を行うことで、これらの疾患のリスクを軽減できます。</span>
    					</div>
    				</div>
    			</article>
    			<article class="flex flex-col dark:bg-gray-50">
    				<a rel="noopener noreferrer" href="/myprofile/sleeping" aria-label="Te nulla oportere reprimique his dolorum">
    					<img alt="" class="object-cover w-full h-52 dark:bg-gray-500" src="/image/baby.jpg">
    				</a>
    				<div class="flex flex-col flex-1 p-6 bg-purple-50">
    					<h3 class="flex-1 py-2 text-lg font-semibold leading-snug">Sleeping Management</h3>
    					<div class="flex flex-wrap justify-between pt-3 space-x-2 text-xs dark:text-gray-600">
    						<span>十分な睡眠を取ることは、身体的健康に多くの利益をもたらします。睡眠中に身体は修復・再生され、免疫機能が強化されます。不十分な睡眠は免疫システムを弱め、感染症や炎症のリスクを高める可能性があります。</span>
    					</div>
    				</div>
    			</article>
    		</div>
    	</div>
        
	    　
  	  @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
      @endif
    </section>
    
</x-app-layout>

