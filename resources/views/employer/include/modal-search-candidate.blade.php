<div class="modal fade" id="candidate{{ $applied->id }}Modal" tabindex="-1"
    aria-labelledby="candidate{{ $applied->id }}ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5">
                    Info : {{ $applied->user->name }}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div>
                    {{ $applied->user->introduce }}
                </div>
                <hr>
                <div>
                    <table class="table table-borderless">
                        <tr>
                            <td class="pe-4">
                                <strong>{{ __('date of birth') }}: </strong>
                                {{ $applied->user->date_of_birth }}
                            </td>
                            <td class="ps-4">
                                <strong>{{ __('sex') }}: </strong>
                                {{ __($applied->user->sex) }}
                            </td>
                        </tr>
                        <tr>
                            <td class="pe-4">
                                <strong>{{ __('location') }}: </strong>
                                {{ $applied->user->location }}
                            </td>
                            <td class="ps-4">
                                <strong>{{ __('address') }}: </strong>
                                {{ $applied->user->address }}
                            </td>
                        </tr>
                        <tr>
                            <td class="pe-4">
                                <strong>{{ __('email') }}: </strong>
                                <a class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                @if ($hasService)
                                    onclick="showContact({{ $applied->id }});"
                                @else
                                    onclick="showContactModal({{$applied->id}})" 
                                @endif
                                    id="showEmail{{ $applied->id }}">
                                    {{ __('click to show email') }}
                                </a>
                            </td>
                            <td class="ps-4">
                                <strong>{{ __('phone') }}: </strong>
                                <a class="link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                @if ($hasService)
                                    onclick="showContact({{ $applied->id }});"
                                @else
                                    onclick="showContactModal({{$applied->id}})" 
                                @endif
                                    id="showPhone{{ $applied->id }}">
                                    {{ __('click to show phone') }}
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>

                @if ($applied->attachment)
                    <hr>
                    <div>
                        <strong>{{ __('attachment') }}: </strong>
                        <u class="text-primary"
                        @if ($hasService)
                            onclick="showContact({{ $applied->id }});"
                        @else
                            onclick="showContactModal({{$applied->id}})" 
                        @endif
                            id="showAttachment{{ $applied->id }}">
                            {{ __('click to show attachment') }}
                        </u>
                    </div>
                @endif

                @if ($applied->user->professionalSkills->count() > 0)
                    <hr>
                    <div>
                        <strong>{{ __('skills') }}: </strong>
                        <div class="d-flex gap-4">
                            @foreach ($applied->user->professionalSkills as $skill)
                                <div
                                    class="d-flex flex-column justify-content-center gap-1">
                                    <span class="badge bg-primary">
                                        {{ $skill->professional_skill }}
                                    </span>
                                    <span class="badge bg-success">
                                        {{ $skill->year . ' ' . __('years') }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($applied->user->workExperiences->count() > 0)
                    <hr>
                    <div>
                        <strong>{{ __('work experience') }}: </strong>
                        @foreach ($applied->user->workExperiences as $workExperience)
                            <div class="timeline-item">
                                <div class="timeline-line"></div>
                                <div class="timeline-dot"></div>
                                <div class="timeline-content ms-4">
                                    <div class="d-flex text-info gap-3">
                                        <div>{{ $workExperience->start_date }}</div>
                                        <div><i class="bi bi-arrow-right"></i></div>
                                        <div>{{ $workExperience->end_date }}</div>
                                    </div>
                                    <div class="d-flex flex-column gap-2">
                                        <div class="fs-5">
                                            {{ $workExperience->company }}
                                        </div>
                                        <pre class="text-secondary">{{ $workExperience->work_experience }}</pre>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if ($applied->user->learningProcesses->count() > 0)
                    <hr>
                    <div>
                        <strong>{{ __('learning_processes') }}: </strong>
                        @foreach ($applied->user->learningProcesses as $education)
                            <div class="timeline-item">
                                <div class="timeline-line"></div>
                                <div class="timeline-dot"></div>
                                <div class="timeline-content ms-4">
                                    <div class="text-secondary">
                                        {{ __('graduation year') }}:
                                        {{ $education->year }}
                                    </div>
                                    <div class="d-flex flex-column gap-2">
                                        <div class="fs-5">
                                            {{ $education->school }}
                                        </div>
                                        <div class="text-secondary">
                                            {{ __('degree') }}:
                                            {{ __($education->degree) }}
                                        </div>
                                        <div class="text-secondary">
                                            {{ __('specialized') }}:
                                            {{ $education->specialized }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if ($applied->user->softSkills->count() > 0)
                    <hr>
                    <div>
                        <strong>{{ __('soft skills') }}: </strong>
                        <div class="d-flex gap-4">
                            @foreach ($applied->user->softSkills as $softSkill)
                                <div
                                    class="d-flex flex-column justify-content-center gap-1">
                                    <span class="badge bg-primary">
                                        {{ $softSkill->soft_skill }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if ($applied->user->languages->count() > 0)
                    <hr>
                    <div>
                        <strong>{{ __('language proficiency') }}: </strong>
                        <div class="d-flex gap-4">
                            @foreach ($applied->user->languages as $language)
                                <div
                                    class="d-flex flex-column justify-content-center gap-1">
                                    <span class="badge bg-primary">
                                        {{ __($language->language) }}
                                    </span>
                                    <span class="badge bg-success">
                                        {{ __($language->proficient) }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if ($applied->user->certificates->count() > 0)
                    <hr>
                    <div>
                        <strong>{{ __('certificate') }}: </strong>
                        <div class="d-flex gap-4">
                            @foreach ($applied->user->certificates as $certificate)
                                <div
                                    class="d-flex flex-column justify-content-center gap-1">
                                    <a href="{{ asset($certificate->link) }}"
                                        class="badge bg-primary" target="_blank">
                                        {{ $certificate->certificate }}
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if ($applied->user->hobbies->count() > 0)
                    <hr>
                    <div>
                        <strong>{{ __('hobby') }}: </strong>
                        <div class="d-flex gap-4">
                            @foreach ($applied->user->hobbies as $hobby)
                                <div
                                    class="d-flex flex-column justify-content-center gap-1">
                                    <span class="badge bg-primary">
                                        {{ $hobby->hobby }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if ($applied->user->desiredLocations->count() > 0)
                    <hr>
                    <div>
                        <strong>{{ __('desired location') }}: </strong>
                        <div class="d-flex gap-4">
                            @foreach ($applied->user->desiredLocations as $desiredLocation)
                                <div
                                    class="d-flex flex-column justify-content-center gap-1">
                                    <span class="badge bg-primary">
                                        {{ $desiredLocation->desired_location }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">{{ __('close') }}</button>
            </div>
        </div>
    </div>
</div>