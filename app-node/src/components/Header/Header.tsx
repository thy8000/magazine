import { useQuery, gql } from "@apollo/client";
import Image  from 'next/image';
import { HeaderQuery } from '../../queries/_index';
import * as socialShareIcons from '../../assets/icons/socialShare/_index';

export default function Header() {
    const { data } = useQuery(HeaderQuery);

    const customLogo = data?.customLogo ?? [];
    const headerCategories = getHeaderCategories(data);

    const socialShares = getSocialShares(data);

    return (
        <header className="flex bg-header">
            <div className="container">
                <div className="flex justify-evenly">
                    <div>
                        { customLogo.url !== null && (
                            <Image
                                className="w-auto"
                                src={customLogo.url}
                                alt={customLogo.description}
                                width={customLogo.width ?? 256}
                                height={customLogo.height ?? 79}
                            />
                        ) }        
                    </div>

                    { headerCategories && (
                        <div>
                            <ul className="flex justify-center items-center gap-8 h-full">
                                {headerCategories?.map((category: any) => (
                                    <li key={category.term_id}>
                                        <a href="#">{category.name}</a>
                                    </li>
                                ))}
                            </ul>
                        </div>
                    ) }

                    { socialShares && (
                        <div>
                            {socialShares?.map((social: any) => (
                                social.url && (
                                    <li>
                                        <Image
                                            className="w-auto"
                                            src={socialShareIcons[social.slug as keyof typeof socialShareIcons]}
                                            alt={social.slug}
                                            width={25}
                                            height={25}
                                        />
                                    </li>
                                )
                            ))}
                        </div>
                    ) }
                </div>
            </div>
        </header>
    );
}

function getHeaderCategories(data: any) {
    const themeOptionsHeader = data?.themeOptionsHeader ?? [];

    if(themeOptionsHeader.categoriesList === undefined) {
        return;
    }

    const headerCategories = JSON.parse(themeOptionsHeader.categoriesList) ?? [];

    return headerCategories;
}

function getSocialShares(data: any) {
    const socialSharesData = data?.customSocialShares?.data ?? [];

    if(socialSharesData.length === 0) {
        return;
    }

    const socialShares = JSON.parse(socialSharesData) ?? [];

    return Object.values(socialShares);
}