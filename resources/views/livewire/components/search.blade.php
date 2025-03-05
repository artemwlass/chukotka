<div>
    <div class="modal search-modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel"
         aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="{{empty($results) ? 'border-bottom: none' : ''}}">
                    <input type="search" placeholder="Search..." wire:model.live="query">
                </div>
                @if(strlen($query) > 1)
                    @if(empty($results))
                        <p class="text-center text-muted">{{__('По вашему запросу ничего не найдено')}}</p>
                    @else
                        <div class="modal-body">
                            <ul>
                                @foreach($results as $result)
                                    <li>
                                        <a href="{{ $result['url'] }}" class="w-100">
                                            {{ is_array($result['title']) ? implode(' ', $result['title']) : $result['title'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>
