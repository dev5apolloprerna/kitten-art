<div class="col-lg-12">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class=" table table-bordered table-striped table-hover datatable">
                                                    <thead>
                                                        <tr class="text-center">
                                                            <th width="50"> Sr No </th>
                                                            <th> Student Name </th>  
                                                            <th> Student Age </th>  
                                                            <th> Age Group </th>  
                                                            <th> Plan Name </th>  
                                                            <th> Total Session </th>  
                                                            <th> Used Session </th>  
                                                            <th> Available Session </th>  
                                                            <th> Status </th>  
                                                        </tr>

                                                    </thead>

                                                    <tbody>

                                                     @if(count($Student) > 0)

                                                    <?php $i = 1;
                                                    $dbalance=0;

                                                    ?>

                                                        @foreach($Student as $key => $sdata)
                                                        <?php 
                                                            $dbalance=$sdata->totalUsedSessions;
                                                        $usedsession = min($sdata->planSession, $dbalance);

                                                        $remainingSession = $sdata->planSession - $usedsession;

                                                        $dbalance -= $usedsession; // Deduct used sessions from balance

                                                

                                                        // If dbalance goes negative, show the remaining session correctly

                                                        if ($dbalance < 0) {

                                                            $remainingSession = $dbalance;

                                                        }
                                                        ?>

                                                            <tr data-entry-id="{{ $sdata->student_id }}" class="text-center">
                                                                <td>
                                                                    {{ $i + $Student->perPage() * ($Student->currentPage() - 1) }}
                                                                </td>
                                                                <td>
                                                                {{ $sdata->student_first_name ?? '' }} {{ $sdata->student_last_name ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->student_age ?? '' }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->categoryName ?? '-'  }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->planName ?? '-'  }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->planSession ?? '0'  }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->totalUsedSessions ?? '-'  }}
                                                                </td>
                                                                <td>
                                                                    {{ $remainingSession ?? '-'  }}
                                                                </td>
                                                                <td>
                                                                    {{ $sdata->attendance}}
                                                                </td>
                                                                
                                                        </tr>
                                                        <?php $i++; ?>
                                                        @endforeach
                                                        @else
                                                         <tr>
                                                            <td colspan="9">
                                                                <center>
                                                            No data Found
                                                        </center>
                                                            <td>
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                             <div class="d-flex justify-content-center mt-3">
                                                {{ $Student->links() }}
                                            </div>
                                              

                                                    <!--end modal -->
                                                </div>
                                            </div>

                                        </div>