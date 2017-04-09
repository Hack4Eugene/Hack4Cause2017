def ReportResource(report):
    return dict(
        id=report.id,
        created_at=report.created_at,
        updated=report.updated,
        date=report.date,
        location=report.location,
        room_number=report.room_number,
        lat=report.geo_latitude,
        lng=report.geo_longitude,
        vehicles=map(VehicleResource, report.vehicles),
        people=map(PersonResource, report.people),
        details=report.details,
        user_id=report.user_id
    )


def VehicleResource(vehicle):
    return dict(
        id=vehicle.id,
        report_id=vehicle.report_id,
        created_at=vehicle.created_at,
        updated=vehicle.updated,
        make=vehicle.make,
        model=vehicle.model,
        color=vehicle.color,
        license_plate=vehicle.license_plate
    )


def PersonResource(person):
    return dict(
        id=person.id,
        report_id=person.report_id,
        created_at=person.created_at,
        updated=person.updated,
        name=person.name,
        category=person.category,
        height=person.height,
        weight=person.weight,
        hair_color=person.hair_color,
        hair_length=person.hair_length,
        eye_color=person.eye_color,
        skin=person.skin,
        sex=person.sex
    )


def UserAdministrationResource(user):
    return dict(
        id=user.id,
        created_at=user.created_at,
        updated=user.updated,
        name=user.name,
        email=user.email,
        phone_number=user.phone_number,
        role=user.role
    )

def AccountResource(user):
    return dict(
        name=user.name,
        email=user.email,
        phone_number=user.phone_number,
        role=user.role
    )
